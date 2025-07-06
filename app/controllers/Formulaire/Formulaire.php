<?php 
    namespace App\Controllers\Formulaire;
    use App\Models\Database\Database;
    
    class Formulaire
    { 

       private static function message_box(string $message):void
       {
        echo "<script>window.alert('" . $message . "');</script>";
       }
            /** 
        * @param string $cookie_name : nom cookie
        * @param array $datas :  tableau a stocker dans le cookie
       */
        private static function souviens_toi_de_moi(string $cookie_name, array $datas , string $isActive)
        {
        
          if(!empty($isActive))
          {
            setcookie($cookie_name,serialize($datas),time() + 84600 * 60);
          }
          else
          {
            return;
          }
     
        }

        public static function sign_in(array $datas, string $methode):void
        {
        
           if($methode === "POST")
           {
             if(empty($datas['email']) || empty($datas['password']))
             {
               header("Location: /login?message=tout les champs sont obligatoire && color=red");
             }

             if(strlen($datas['email']) < 9)
             {
               header("Location: /login?message=l email doit avoir au moins 9 caracteres && color=red");
             }

             if(strlen($datas['password']) < 9)
             {
          
               header('Location:/login?message=le mot de passe doit avoir 9 caracteres && color=red');
             }

             if(!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) 
             {
                header("Location:/login?message=addresse email invalide && color=danger");
             }

             if(!preg_match("/^[a-zA-Z0-9]*$/",$datas['password']))
             {
                header("Location: /login?message=le mot de passe doit contenir dea chiffres et des lettres && color=danger");
             }   

             else
             {
              
              $email = $datas['email'];
              $mdp = $datas['password'];
              $user_exists =  Database::executeQuery('SELECT * FROM users  WHERE mails=:mail',[':mail' => $email],2);
                          
              if(count($user_exists) > 0)
              {
               if(password_verify($mdp,$user_exists[0]['mdps'])){
                  Database::executeQuery('UPDATE users SET status=1 WHERE mails=:email',[':email' =>$email],3);
                  $_SESSION['user'] = Database::executeQuery('SELECT * FROM users  WHERE mails=:mail',[':mail' => $email],2)[0];
                  self::souviens_toi_de_moi("Tokken",$datas,$datas['remember']?? '');
                  self::message_box('connexion reussi');
                  \App\Middlewares\Security\Security::verify_role($_SESSION['user']['role']);
               }
               else{
                self::message_box('mot de passe incorrect');
                header('Location:/login');
               }

              }

              else
              {
                header("Location: /login?message=veuillez creer un compte &&color=red");
              }

             } 
          }
          else{}
        }

        public  static function sign_up(array $datas, string $methode):void
        {     
            if($methode === "POST")
            {
               if( empty($datas['age']) || empty($datas['prenom']) || empty($datas['email'])  || empty($datas['password']) || empty($datas['confirmPassword']) || empty($datas['sexe']) || empty($datas['pseudo'])) 
               {
                  header("Location: /login?message=tout les champs sont obligatoire && color=red");
                   exit;
               }

               if(strlen($datas['email']) < 9)
               {
                 header("Location: /login?message=l email doit avoir au moins 9 caracteres && color=red");
                  exit;
               }

               if(strlen($datas['password']) < 9)
               {
                  header('Location:/login?message=le mot de passe doit avoir 9 caracteres && color=red');
                   exit;
               }
               if(strlen($datas['pseudo']) < 6)
               {
                 header("Location: /login?message=le pseudo doit avoir au moins 3 caracteres && color=red");
                  exit;
               }

               if (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) 
               {
                 header("Location :/login?message=addresse email invalide && color=red");
                  exit;
               }
             
               if ($datas['password'] !== $datas['confirmPassword'])
               {
                  header("Location: /login?message = les mots de passe doivent etre similaire && color=red");
                  exit;
               }

               if(!preg_match("/^[a-zA-Z0-9]*$/",$datas['pseudo']))
               {
                header("Location:/login?message=le pseudo doit avoir des chiffres et des lettres");
                exit;
               }
 
               if(!preg_match("/^[a-zA-Z]*$/",$datas['prenom']) || !preg_match("/^[a-zA-Z]*$/",$datas['sexe']))
               {

                 header("Location: /register?message=le nom et genre doivent etre compose de lettre et chiffre && color=red");
                  exit;
               }
                 
              else
              {
                $user_exists = Database::executeQuery("SELECT * FROM users WHERE mails=:email AND mdps=:mdp",[
                  ':email' => $datas['email'],
                  ':mdp' => $datas['password']
                ],2);

              
                if(count($user_exists) > 0)
                {
                 echo  self::message_box("ce compte existe déjà");
                  header("Location: /login");
                }
                else
                {
                  $role = ($datas['email'] == "henoctumonakiese@gmail.com" && $datas['password'] == "Velonica9") ? "administrateur" :"utilisateur";
               
                  Database::executeQuery("INSERT INTO users(prenoms, pseudo, mails, mdps,status,genre,tranche_age,role,avatar) 
                                          VALUES (:prenom, :pseudo,:email,:mdp,:status,:sexe,:age,:role,:avatar)",[
                    ':prenom' => $datas['prenom'],
                    ':pseudo' => $datas['pseudo'],
                    ':email' => $datas['email'],
                    ':mdp' => password_hash($datas['password'],PASSWORD_DEFAULT),
                    ':status' => 0,
                    ':sexe' => $datas['sexe'],
                    ':age' => $datas['age'],
                    ':role' => $role,
                    ':avatar' => '/assets/avatar.png'
                  ],1);
                  self::message_box("compte crée avec success");
                  header("Location: /login");
                  exit;
                }

              }
            }
            else
             {
                header("Location: /login");
             }
        }
    }
?>