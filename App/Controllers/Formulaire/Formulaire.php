<?php 
    namespace App\Controllers\Formulaire;
    use App\Models\Database\Database;
    
    class Formulaire
    { 
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
                header("Location :/login?message=addresse email invalide && color=red");
             }

             if(!preg_match("/^[a-zA-Z0-9]*$/",$datas['password']))
             {
                header("Location: /login?message=le mot de passe doit contenir dea chiffres et des lettres && color=red");
             }   

             else
             {
              
              $email = $datas['email'];
              $mdp = $datas['password'];
              $user_exists =  Database::QueryRequest("SELECT * FROM users  WHERE mails='$email' AND mdps='$mdp'",2);
            
             
              if(count($user_exists) > 0)
              {
               Database::QueryRequest("UPDATE users SET status=1 WHERE mails='$email'",3);
               $_SESSION['user'] = Database::QueryRequest("SELECT * FROM users  WHERE mails='$email' AND mdps='$mdp'",2);
               self::souviens_toi_de_moi("Tokken",$datas,$datas['remember']?? '');
              
                header("Location: /home");
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
                var_dump( 
                  Database::executeQuery("SELECT * FROM users WHERE mails=:email AND mdps=:mdp",[
                  ':email' => $datas['email'],
                  ':mdp' => $datas['password']
                ],2));
               

                $user_exists = Database::executeQuery("SELECT * FROM users WHERE mails=:email AND mdps=:mdp",[
                  ':email' => $datas['email'],
                  ':mdp' => $datas['password']
                ],2);

              
                if(count($user_exists) > 0)
                {
                  header("Location: /error/ce0compte0existe0deja");
                }
                else
                {
                  $role = ($datas['email'] === "henoctumonakiese@gmail.com" && $datas['password'] === "Holande23") ? "administrateur" :"utilisateur";
               
                  Database::executeQuery("INSERT INTO users(prenoms, pseudo, mails, mdps,status,genre,tranche_age,role) 
                                          VALUES (:prenom, :pseudo,:email,:mdp,:status,:sexe,:age,:role)",[
                    ':prenom' => $datas['prenom'],
                    ':pseudo' => $datas['pseudo'],
                    ':email' => $datas['email'],
                    ':mdp' => $datas['password'],
                    ':status' => 0,
                    ':sexe' => $datas['sexe'],
                    ':age' => $datas['age'],
                    ':role' => $role
                  ],1);
                  
                  header("Location: /error/votre0compte0creer0avec0succes");
                
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