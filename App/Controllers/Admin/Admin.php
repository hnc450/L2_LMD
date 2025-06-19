<?php
    namespace App\Controllers\Admin;
    use App\Controllers\Action\Action;
    use App\Models\Database\Database;
    use App\Controllers\User\User;
    
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
            var_dump($datas);
            if($methode ==="POST")
            {

            //   Database::executeQuery("INSERT INTO jeux (titre, niveau, categorie, duration,description) VALUES (:t,:n,:c,:d,:dc)", $datas,1);
            //   header("Location: /dahsboard");
            }
            else
            {
                header("Location: /home");
            }
        }

        public static function ajouter_un_exploration(array $datas , string $methode) 
        {
            var_dump($datas);

            if($methode ==="POST")
            {
               
            }
            else
            {
                header("Location: /home");
            }
        }

        public static function ajouter_une_categorie(array $datas) 
        {
            var_dump($datas);
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

    }

?>
