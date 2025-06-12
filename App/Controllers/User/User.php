<?php
    namespace App\Controllers\User;
    use App\Models\Database\Database;
    use App\Controllers\Action\Action;
    
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
          // Vérifier si un fichier a été soumis
           if ($request === 'POST' && isset($_FILES['image'])) {
               $uploadDir = './assets/photos/'; // Chemin vers le dossier de stockage
               $file = $_FILES['image'];
              
               // Vérifier les erreurs d'upload
               if ($file['error'] !== UPLOAD_ERR_OK) {
                   die('Erreur lors de l\'upload du fichier.');
                   header("Location: /profile?message=Erreur lors de l envoie du fichier");
               }
              
               // Vérifier si le fichier est une image
               $fileType = mime_content_type($file['tmp_name']);
               if (strpos($fileType, 'image/') !== 0) {
                   die('Le fichier soumis n\'est pas une image.');
               }
              
               // Générer un nom unique pour le fichier
               $fileName = uniqid('photo_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
              
               // Déplacer le fichier dans le dossier de destination
               if (!is_dir($uploadDir)) {
                   mkdir($uploadDir, 0755, true); // Créer le dossier s'il n'existe pas
               }
              
               $destination = $uploadDir . $fileName;
               if (move_uploaded_file($file['tmp_name'], $destination)) {
                   echo 'Image uploadée avec succès !';
               } else {
                   echo 'Erreur lors du déplacement du fichier.';
                   header("Location: /profile?message=Erreur lors du deplacement du fichier && color=red");
               }
           } else {
               header("Location: /profile?message=Aucun fichier soumis&&color=red");
           }
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
                header("Location: /error/le0pseudo0doit0avoir0entre060et020caracteres");
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
                  header("Location: /parametres");
                }

              }

          }
        }
   }
?>