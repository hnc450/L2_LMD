<?php
    namespace App\Controllers\Admin;
    use App\Controllers\Action\Action;
    use App\Models\Database\Database;
    use App\Controllers\User\User;
    use App\Models\Exploration\Exploration ;
    
    class Admin extends User
    {
        public static function delete_user_by_id(int $user_id) 
        {
            try {
               
                if(!is_numeric($user_id) || $user_id <= 0){
                    return false;
                }
             
                $query = "DELETE FROM users WHERE id_user = $user_id";
                $result = Database::QueryRequest($query, 4);
                header("Location: /admin/dahsboard");
                
            } catch (\PDOException $e) {
              
                error_log("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
                return false;
            }
        }
        public  static function voir_toutes_les_informations():array
        {
            return [
                'actifs_users' => Database::QueryRequest("SELECT COUNT(*) AS actifs FROM users WHERE status = 1", 2),
                'inatifs_user'=> Database::QueryRequest("SELECT COUNT(*) AS inatifs FROM users WHERE status = 0", 2),
                'utilisateurs_inscrits'=> Database::QueryRequest("SELECT COUNT(*) AS utilisateurs_inscrits FROM users", 2),
                'administrateurs'=> Database::QueryRequest("SELECT COUNT(*) AS administrateurs FROM users WHERE role = 'administrateur'", 2) ,
                'categories' => Database::QueryRequest("SELECT COUNT(*) AS nombre_categorie FROM categories", 2),
                'explorations' => Database::QueryRequest('SELECT COUNT(*) AS nombres_explorations FROM explorations',2),
                'jeux' => Database::QueryRequest('SELECT COUNT(*) AS nombres_jeux FROM jeux',2)
            ];
        }

        public static function get_all_users() 
        {
            try {
                $query = "SELECT * FROM users";
                $result = Database::QueryRequest($query, 2);
                return $result;
            } catch (\PDOException $e) {
                error_log("Erreur lors de la récupération des utilisateurs: " . $e->getMessage());
                return [];
            }
        }
        /**
         * Récupère un utilisateur par son identifiant.
         *
         * @param mixed $tag L'identifiant de l'utilisateur.
         * @return array|false Les données de l'utilisateur ou false en cas d'erreur.
         */
        public static function get_user_by_tag(mixed $tag) 
        {
           
            try {
              return Action::filtrer_table_by_key("users", $tag);
            } catch (\PDOException $e) {
                error_log("Erreur lors de la récupération de l'utilisateur: " . $e->getMessage());
                return [];
            }
        }

        public static function ajouter_un_jeu(array $datas , string $methode) 
        {
            $params = [
                ':titre' => $datas['titre'],
                ':age'=> $datas['age'],
                ':id_cat'=> $datas['category'],
                ':duration'=> $datas['duration'],
                ':descr'=> $datas['description'],
                ':slug'=> $datas['slug'],
              
            ];
          
            if($methode ==="POST")
            {
           
              Database::executeQuery("INSERT INTO jeux(titre,age,id_categorie, duration,description,slug_img,contenu)
              VALUES (:titre,:age,:id_cat,:duration,:descr,:slug,:contenu)", $params,1);
         
              header("Location:/administration/contenus");
            }
        
            else
            {
                header("Location: /home");
            }
        }

        public static function ajouter_un_exploration(array $datas , string $methode) 
        {
            if($methode ==="POST")
            {  
                Exploration::create($datas['titre'],$datas['slug'],$datas['categorie'],$datas['contenu'],$datas['description']);
                header("Location: /administration/contenus");
                exit();
            }
            else
            {
                header("Location: /home");
            } 
        }

        public static function add_user(array $datas){
            \App\Controllers\Formulaire\Formulaire::instance()->sign_up($datas,'POST');
        }
        public static function update_user(array $datas, int $id){
            if((int)$datas['id_user'] === $id){
               \App\Models\Database\Database::executeQuery('UPDATE users SET prenoms=:pr,pseudo=:ps,mails=:m,status=:st,genre=:g,role=:r WHERE id_user=:i',[
                   ':i' => $id,
                   ':pr' => htmlspecialchars(trim($datas['prenom'])),
                   ':ps' => strip_tags(htmlspecialchars(trim($datas['pseudo']))),
                   ':m' => strip_tags(htmlspecialchars(trim($datas['email']))),
                   ':st' => strip_tags(htmlspecialchars(trim($datas['status']))),
                   ':g' => strip_tags(htmlspecialchars(trim($datas['genre']))),
                   ':r' => strip_tags(htmlspecialchars(trim($datas['role'])))
               ],4);
               header('Location: /administration/users');
            }
        }

        public static function modifier_exploration(array $datas, string $methode, int $id)
        {
            if($methode === "PUT")
            {
                $titre = $datas['titre'] ?? '';
                $categorie = $datas['categorie'] ?? '';
                $info = $datas['info'] ?? '';
               // Exploration::update($id, $titre, $categorie, $info);
                header("Location: /administration/contenus");
            }
            else
            {
                header("Location: /home");
            }
        }

        public static function supprimer_exploration(int $id)
        {
            Exploration::delete($id);
            header("Location: /administration/contenus");
        }

        public static function ajouter_une_categorie(array $datas) 
        {
            Database::executeQuery("INSERT INTO categories (id_categorie, categorie) VALUES (:id,:category)", [
                'id' => $datas['categoryId'],
                'category' => $datas['categoryName']
            ],1);
            header("Location: /administration/dashboard");
        }

        public static function supprimer_une_categorie(string $id) 
        {
            try {
                if(Action::check_existence("categories","id_categorie",$id)) {

                    $query = "DELETE FROM categories WHERE id_categorie = :id";
                    $params = [':id' => $id];
                    Database::executeQuery($query, $params, 4);
                    header("Location: /administration/contenus");
                    return true;
                }

                else
                {
                    return false;
                }
            } catch (\PDOException $e) {
                error_log("Erreur lors de la suppression de la catégorie: " . $e->getMessage());
                return false;
            }
        }

        public static function banir_utilisateur(int $id_user) 
        {
            try {
                if(!is_numeric($id_user) || $id_user <= 0) {
                    return false;
                }

                // Récupérer la gravité de l'infraction depuis la session ou la requête
                $gravite = $_POST['gravite'] ?? 'moyenne';
                
                // Définir la durée du bannissement en fonction de la gravité
                $duree = match($gravite) {
                    'legere' => '1 day',
                    'moyenne' => '7 days',
                    'grave' => '30 days',
                    'tres_grave' => '365 days',
                    default => '7 days'
                };

                // Mettre à jour le statut de l'utilisateur et la date de fin de bannissement
                $query = "UPDATE users SET 
                         status = 0, 
                         ban_end_date = DATE_ADD(NOW(), INTERVAL $duree),
                         ban_reason = :reason 
                         WHERE id_user = :id_user";
                         
                $params = [
                    'reason' => $_POST['reason'] ?? 'Violation des règles',
                    'id_user' => $id_user
                ];

                Database::executeQuery($query, $params, 1);
                header("Location: /administration/users");
                return true;
                
            } catch (\PDOException $e) {
                error_log("Erreur lors du bannissement de l'utilisateur: " . $e->getMessage());
                return false;
            }
        }

        public static function supprimer_jeu(int $id)
        {
            try {
                $query = "DELETE FROM jeux WHERE id_jeu = :id";
                $params = [':id' => $id];
                Database::executeQuery($query, $params, 4);
                header("Location: /administration/contenus");
                exit();
            } catch (\PDOException $e) {
                error_log("Erreur lors de la suppression du jeu: " . $e->getMessage());
                return false;
            }
        }

        public static function modifier_jeu(int $id, array $datas, string $methode)
        {
            if ($methode === "PUT" || $methode === "POST") {
                try {
                    $params = [
                        ':id' => $id,
                        ':titre' => $datas['titre'],
                        ':slug_img' => $datas['slug_img'],
                        ':duration' => $datas['duration'],
                        ':description' => $datas['description'],
                        ':age' => $datas['age'],
                        ':id_categorie' => $datas['category'] ?? $datas['id_categorie']
                    ];
                    $query = "UPDATE jeux SET titre = :titre, slug_img = :slug_img, duration = :duration, description = :description, age = :age, id_categorie = :id_categorie WHERE id_jeu = :id";
                    Database::executeQuery($query, $params, 1);
                    // header("Location: /administration/contenus");
                    exit();
                } catch (\PDOException $e) {
                    error_log("Erreur lors de la modification du jeu: " . $e->getMessage());
                    return false;
                }
            } else {
                header("Location: /user/home");
            }
        }


        public static function modifier_module(int $id, array $datas, string $methode)
        {
            if ($methode === "PUT" || $methode === "POST") {
                try {
                    $params = [
                        
                        ':titre' => $datas['titre'],
                        ':description' => $datas['description'],
                        ':categorie' => $datas['categorie'],
                        ':niveau' => $datas['niveau']
                    ];
                    $query = "UPDATE modules SET noms=:titre, content = :content, categorie_id =:categorie, niveau = :niveau WHERE id_module = :id";
                    \App\Models\Database\Database::executeQuery($query, $params, 1);
                    header("Location: /administration/contenus");
                    exit();
                } catch (\PDOException $e) {
                    error_log("Erreur lors de la modification du module: " . $e->getMessage());
                    return false;
                }
            } else {
                header("Location: /home");
            }
        }

            // ... existing code ...

    // Afficher tous les paramètres admin
    public static function get_admin_settings() {
        return \App\Models\SettingModel::getAllAdminSettings();
    }

    // Ajouter ou modifier un paramètre admin
    public static function save_admin_setting($name, $value,$id) {
        return \App\Models\SettingModel::saveSetting($name, $value, $id); 
    }

    // Supprimer un paramètre admin
    public static function delete_admin_setting($id) {
        return \App\Models\SettingModel::deleteSetting($id);
    }

    public static function add_module(array $datas){
    
       if(empty($datas['titre-module']) && empty($datas['content-module']) && empty($datas['category-module']) && empty($datas['level-module'])){
        header('Location: /administration/contenus');
        exit;
       }
        Database::executeQuery('INSERT INTO modules(noms, categorie_id,content,levels) VALUES(:nom,:categorie,:content,:levels)',[
            ':nom'=> $datas['titre-module'],
            ':categorie' => $datas['category-module'],
            ':content'=> $datas['content-module'],
            ':levels' => $datas['level-module']
        ],1);
        header('Location: /administration/contenus');
        exit;
    }

}

?>
