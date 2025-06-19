<?php
    namespace App\Controllers\User;
    use App\Models\Database\Database;
    use App\Controllers\Action\Action;
    use Exception;
    
   class User
   {
        public  static function se_deconnecter()
        {
          $id = $_SESSION['user'][0]['id_user'];
          session_destroy();
          unset($_SESSION['user']);
          Database::QueryRequest("UPDATE users SET status=0 WHERE id_user=$id",3);
          header("Location: /");
        }

  

        public static function modifier_profile(string $request, $fichier)
        {
            // Utilisation du middleware Upload
            \App\Middlewares\Security\Security::require_auth();
            if ($request === 'POST' && isset($_FILES['image'])) {
                require_once __DIR__ . '/../../Middlewares/Request/Upload.php';
                $uploadDir = 'public/uploads/avatars/';
                $file = $_FILES['image'];
                $userId = $_SESSION['user'][0]['id_user'];
                // Upload sécurisé
                $avatarPath = \Upload::upload_image($file, $uploadDir);
                if ($avatarPath) {
                    // Supprimer l'ancien avatar si ce n'est pas l'avatar par défaut
                    $user = Database::QueryRequest("SELECT avatar FROM users WHERE id_user=$userId", 2);
                    if (!empty($user[0]['avatar']) && strpos($user[0]['avatar'], 'default') === false) {
                        \Upload::delete_image($user[0]['avatar']);
                    }
                    // Mettre à jour la BDD
                    Database::executeQuery("UPDATE users SET avatar=:avatar WHERE id_user=:id", [
                        ':avatar' => $avatarPath,
                        ':id' => $userId
                    ], 3);
                    $_SESSION['user'][0]['avatar'] = $avatarPath;
                    header("Location: /profile?message=Avatar mis à jour avec succès");
                } else {
                    header("Location: /profile?message=Erreur lors de l'upload de l'image&&color=red");
                }
            } else {
                header("Location: /profile?message=Aucun fichier soumis&&color=red");
            }
        }

        /**
         * Supprime l'avatar utilisateur (remet l'avatar par défaut)
         */
        public static function supprimer_avatar(int $id)
        {
            \App\Middlewares\Security\Security::require_auth();
            require_once __DIR__ . '/../../Middlewares/Request/Upload.php';
            $user = Database::QueryRequest("SELECT avatar FROM users WHERE id_user=$id", 2);
            if (!empty($user[0]['avatar']) && strpos($user[0]['avatar'], 'default') === false) {
                \Upload::delete_image($user[0]['avatar']);
            }
            $default = 'public/uploads/avatars/default.png';
            Database::executeQuery("UPDATE users SET avatar=:avatar WHERE id_user=:id", [
                ':avatar' => $default,
                ':id' => $id
            ], 3);
            $_SESSION['user'][0]['avatar'] = $default;
            header("Location: /profile?message=Avatar supprimé");
        }

  
        public static function supprimer_mon_compte(int $id)
        {
          
          if(Action::check_existence("users","id_user",$id))
          {
            if($_SESSION['user'][0]['id_user'] !== $id)
            {
              header("Location: /error/ce0compte0n0est0pas0le0votre");
              exit();
            }
            else
            {
              Database::executeQuery("DELETE FROM users WHERE id_user=:id",[':id'=> $id],4);
              echo "<script>alert('Votre compte a été supprimé avec succès.');</script>";
              User::se_deconnecter();
            }
            
          }
          else
          {
            header("Location: /error/ce0compte0est0inexistant0ou0il0a0deja0ete0supprime");
          }
        }
        
        public  static function modifier_information_compte(array $datas, string $methode, int $id):void
        {
        
          if($methode ==="POST")
          {
              if(empty($datas['email']) ||  empty($datas['pseudo']) || empty($datas['prenom']))
              {
                header("Location: /error/tout0les0champs0sont0obligatoires");
              }

              if(strlen($datas['email']) < 9)
              { 
                header("Location: /error/l0email0doit0avoir0plus0de090caracteres");
              }

              if(strlen($datas['pseudo']) < 3 || strlen($datas['pseudo']) > 20)
              { 
                header("Location: /error/le0pseudo0do les it0avoir0entre060et020caracteres");
              }

              if(!preg_match('/^[a-zA-Z]+$/', $datas['prenom'])) 
              {
                header("Location: /error/le0prenom0doit0avoir0que0des0et0des0lettres");
              }
             
              if(!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) 
              {
                header("Location: /error/l0email0n0est0pas0valide");
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

                $_SESSION['user'][0]['mails'] = $email;
                $_SESSION['user'][0]['pseudo'] = $pseudo;
                $_SESSION['user'][0]['prenoms'] = $prenom;
                 header("Location: /profile");
              }
          }
          
        }

        public static function modifier_mot_de_passe(array $datas, string $methode , int $id)
        {
         
          if($methode ==="POST")
          {
              if(empty($datas['current_password']) ||empty($datas['new_password']) || empty($datas['confirm_password']))
              {
                header("Location: /error/tout0les0champs0sont0obligatoires");
              }

              if(strlen($datas['current_password'] < 9 || strlen($datas['new_password']) < 9|| strlen($datas['confirm_password']) < 9))
              { 
                header("Location: /error/le0mot0de0passe0doit0avoir0plus0de090caracteres");
              }

              if($datas['new_password'] !== $datas['confirm_password'])
              {
                header("Location: /error/le0nouveau0mot0de0passe0et0la0confirmation0ne0correspondent0pas");
              }

              // if(!preg_match('/^[a-zA-Z0-9]$/',$datas['current_password']) || !preg_match('/^[a-zA-Z0-9]$/',$datas['new_password'])  || !preg_match('/^[a-zA-Z0-9]$/',$datas['confirm_password']))
              // {
              //    header("Location: /error/le0mot0de0passe0doit0avoir0des0chiffres0et0des0lettres");
              // }

              else
              {
                if(!Action::check_existence("users","id_user",$id))
                {
                 header("Location: /error/ce0compte0est0inexistant0ou0n0est0pas0a0vous");
                }
                else
                {
                  $mdp = $datas['new_password'];
                  Database::QueryRequest("UPDATE users SET mdps='$mdp' WHERE id_user=$id",3);
                  $_SESSION['user'][0]['mdps'] = $mdp;
                  header("Location: /user/parametres");
                }

              }

          }
        }

        public function envoyer_message($contenu) {
            try {
                if (empty($contenu)) {
                    throw new Exception("Le message ne peut pas être vide");
                }

                $user_id = $_SESSION['user'][0]['id_user'];
                $sql = "INSERT INTO messages (sender_id, content, created_at) VALUES (?, ?, NOW())";
                $params = [$user_id, $contenu];
                
                Database::executeQuery($sql, $params,1);
                return true;
            } catch (Exception $e) {
                error_log("Erreur lors de l'envoi du message : " . $e->getMessage());
                return false;
            }
        }

        public static function recuperer_messages($limit = 50) {
            try {
                $sql = "SELECT m.*, u.prenoms, u.role
                        FROM messages m 
                        JOIN users u ON m.sender_id = u.id_user 
                        ORDER BY m.created_at DESC 
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
   }
?>