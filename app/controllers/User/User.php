<?php
    namespace App\Controllers\User;
    use App\Models\Database\Database;
    use App\Controllers\Action\Action;
    use Exception;
    use App\Models\Exploration\Exploration as ExplorationModel;
    
   class User
   {
        public  static function se_deconnecter()
        {
          $id = $_SESSION['user']['id_user'];
          Database::QueryRequest("UPDATE users SET status=0 WHERE id_user=$id",3);
          unset($_SESSION['user']);
          session_destroy();
          $_SESSION = [];
          header("Location: /login");
        }
  
        public static function modifier_profile(string $request, $fichier)
        {
            \App\Middlewares\Security\Security::require_auth();
            if ($request === 'POST' && isset($fichier['image'])) {
          
                $uploadDir = __DIR__ . '/../../../public/assets/';
                $file = $fichier['image'];
                $avatarPath = \App\Middlewares\Upload\Upload::upload_image($file, $uploadDir);
                if ($avatarPath) {
                    // On ne garde que le nom du fichier pour le chemin web
                    $fileName = basename($avatarPath);
                    $webAvatarPath = '/assets/' . $fileName;
                    $userId = $_SESSION['user'][0]['id_user'];
                    $user = Database::QueryRequest("SELECT avatar FROM users WHERE id_user=$userId", 2);
                    if (!empty($user[0]['avatar']) && strpos($user[0]['avatar'], 'default') === false) {
                        \App\Middlewares\Upload\Upload::delete_image($user[0]['avatar']);
                    }
                    Database::executeQuery("UPDATE users SET avatar=:avatar WHERE id_user=:id", [
                        ':avatar' => $webAvatarPath,
                        ':id' => $userId
                    ], 3);
                    $_SESSION['user'][0]['avatar'] = $webAvatarPath;
                    echo "<script>window.alert('Profil mis à jour avec success')</script>";
                    header("Location: /user/profile");
                } else {
                    echo "<script>window.alert('Erreur lors de l envoie de l image')</script>";
                    header("Location: /user/profile");
                }
            } else {
                echo "<script>window.alert('Aucun fichier soummis')</script>";
                header("Location: /user/profile");
            }
        }
        /**
         * Supprime l'avatar utilisateur (remet l'avatar par défaut)
         */
        public static function supprimer_avatar(int $id)
        {
            \App\Middlewares\Security\Security::require_auth();
   
            $user = Database::QueryRequest("SELECT avatar FROM users WHERE id_user=$id", 2);
            if (!empty($user[0]['avatar'])) {
                // Correction : utiliser le chemin absolu pour la suppression
                $avatarPath = $_SERVER['DOCUMENT_ROOT'] . $user[0]['avatar'];
                \App\Middlewares\Upload\Upload::delete_image($avatarPath);  
            }
            $default = '/assets/avatar.png';
            Database::executeQuery("UPDATE users SET avatar=:avatar WHERE id_user=:id", [
                ':avatar' => $default,
                ':id' => $id
            ], 3);
            $_SESSION['user'][0]['avatar'] = $default;
            header("Content-Type: application/json");
            echo json_encode(["success" => "avatar supprimé avec succès"]);
        }

  
        public static function supprimer_mon_compte(int $id)
        {
          
          if(Action::check_existence("users","id_user",$id))
          {
            if($_SESSION['user']['id_user'] !== $id)
            {
              $_SESSION['message'] = "ce compte n est pas le votre";
              header("Location: /user/profile");
              exit();
            }
            else
            {
              Database::executeQuery("DELETE FROM users WHERE id_user=:id",[':id'=> $id],4);
              setcookie('Tokken', '', time() - 3600, '/');
              User::se_deconnecter();
              header('Location: /user/profile');
         
            }
            
          }
          else
          {
            header("Location: /error/403");
          }
        }
        
        public  static function modifier_information_compte(array $datas, string $methode, int $id):void
        {
        
          if($methode ==="POST")
          {
              if(empty($datas['email']) ||  empty($datas['pseudo']) || empty($datas['prenom']))
              {
                //header("Location: /error/tout0les0champs0sont0obligatoires");
              }

              if(strlen($datas['email']) < 9)
              { 
                //header("Location: /error/l0email0doit0avoir0plus0de090caracteres");
              }

              if(strlen($datas['pseudo']) < 3 || strlen($datas['pseudo']) > 20)
              { 
               // header("Location: /error/le0pseudo0do les it0avoir0entre060et020caracteres");
              }

              if(!preg_match('/^[a-zA-Z]+$/', $datas['prenom'])) 
              {
                //header("Location: /error/le0prenom0doit0avoir0que0des0et0des0lettres");
              }
             
              if(!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) 
              {
                //header("Location: /error/l0email0n0est0pas0valide");
              }

              else
              {
                $id = $_SESSION['user'][0]['id_user'];
                $email = strip_tags(htmlspecialchars($datas['email']));
                $pseudo = strip_tags(htmlspecialchars($datas['pseudo']));
                $prenom = strip_tags(htmlspecialchars( $datas['prenom']));
                Database::executeQuery("UPDATE users SET mails=:email, pseudo=:pseudo, prenoms=:prenom WHERE id_user=:id", 
                [
                 ':email' => $email,
                 ':pseudo' => $pseudo,
                 ':prenom' => $prenom, 
                 ':id' => $id], 3);

                $_SESSION['user']['mails'] = $email;
                $_SESSION['user']['pseudo'] = $pseudo;
                $_SESSION['user']['prenoms'] = $prenom;
                 header("Location: /profile");
              }
          }
          
        }

        public static function modifier_mot_de_passe(array $datas, string $methode , int $id)
        {
         
          if($methode ==="PUT")
          {
              if(empty($datas['mdp']) || empty($datas['confirm']))
              {
               
              }

              if(strlen($datas['mdp']) < 9|| strlen($datas['confirm']) < 9)
              { 

              }

              if($datas['mdp'] !== $datas['confirm'])
              {

              }

              if(!preg_match('/^[a-zA-Z0-9]$/',$datas['mdp'])  || !preg_match('/^[a-zA-Z0-9]$/',$datas['confirm']))
              {
      
              }

              else
              {
                if(!Action::check_existence("users","id_user",$id))
                {
              
                }
                else
                {
                  
                  $mdp = password_hash($datas['mdp'],PASSWORD_DEFAULT);
                  Database::executeQuery('UPDATE users SET mdps=:mdp WHERE id_user=:id',[':mdp'=>$mdp,':id'=>$id],3);
                  $_SESSION['user']['mdps'] = $mdp;
                }

              }

          }
        }

        public function envoyer_message($contenu) {
            \Messages\Messages::getInstance()->sendMessage($contenu);
        }

        public static function recuperer_messages($limit = 50) {
            try {
                $sql = "SELECT m.*, u.prenoms, u.role
                        FROM messages m 
                        JOIN users u ON m.sender_id = u.id_user 
                        ORDER BY m.created_at ASC
                        LIMIT $limit";
                // $params = [$limit];
                
               //$messages = Database::executeQuery($sql,[$limit],2);

               $messages = Database::QueryRequest($sql, 2);
              //  var_dump(array_reverse(
              //   $messages));
               
              return $messages;
                //return array_reverse($messages); // Pour avoir les messages dans l'ordre chronologique
            } catch (Exception $e) {
                error_log("Erreur lors de la récupération des messages : " . $e->getMessage());
                return [];
            }
        }

        public static function ajouter_une_exploration(array $datas, string $methode)
        {
            \App\Middlewares\Security\Security::require_role('joueur');
            if($methode === "POST") {
                $titre = $datas['titre'] ?? '';
                $categorie = $datas['categorie'] ?? '';
                $info = $datas['info'] ?? '';
                $user_id = $_SESSION['user'][0]['id_user'];
                //Exploration::create($titre, $categorie, $info, $user_id);
                header("Location: /explorations?success=1");
            }
        }

        public static function modifier_exploration(array $datas, string $methode, int $id)
        {
            \App\Middlewares\Security\Security::require_role('joueur');
            if($methode === "POST") {
                $titre = $datas['titre'] ?? '';
                $categorie = $datas['categorie'] ?? '';
                $info = $datas['info'] ?? '';
                $user_id = $_SESSION['user'][0]['id_user'];
                ExplorationModel::update($id, $titre, $categorie, $info, $user_id);
                header("Location: /explorations?success=1");
            }
        }

        public static function supprimer_exploration(int $id)
        {
            \App\Middlewares\Security\Security::require_role('joueur');
            $user_id = $_SESSION['user'][0]['id_user'];
            ExplorationModel::delete($id, $user_id);
            header("Location: /explorations?deleted=1");
        }

        /**
         * Retourne la liste des utilisateurs en ligne (status=1)
         */
        public static function get_online_users() {
            $sql = "SELECT id_user, prenoms, avatar, role FROM users WHERE status = 1";
            return \App\Models\Database\Database::QueryRequest($sql, 2);
        }
   }
?>