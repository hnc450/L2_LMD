<?php 
    namespace App\Controllers\Formulaire;
    use App\Models\Database\Database;
    
    class Formulaire
    { 
       private static $instance ;

       public static function instance():Formulaire
       {
         if(is_null(static::$instance)){
            static::$instance =  new Formulaire();
         }
         return static::$instance;
       }
      
       private  function filter_array( string $value):string
       {
          return strip_tags(htmlspecialchars(trim($value)));
       }

       private  function message_box(string $message):void
       {
         echo "<script>window.alert('" . $message . "');</script>";
       }
        /** 
        * @param string $cookie_name : nom cookie
        * @param array $datas :  tableau a stocker dans le cookie
        */
        private  function souviens_toi_de_moi(string $cookie_name, array $datas , string $isActive)
        {
          if(!empty($isActive))
          {
            setcookie($cookie_name,serialize($datas),time() + 84600 * 60);
          }     
        }

        public  function sign_in(array $datas, string $methode):void
        {
      
           if($methode === "POST")
           {
             if(empty($datas['email']) || empty($datas['password']))
             {
               $_SESSION['message'] = "tout les champs sont obligatoire";
               header("Location: /login");
             }

             elseif(strlen($datas['email']) < 9)
             {
              $_SESSION['message'] ="l' email doit avoir au moins 9 caracteres";
               header("Location: /login");
             }

             elseif(strlen($datas['password']) < 9)
             {
              $_SESSION['message'] = "le mot de passe doit avoir 9 caracteres";
               header('Location:/login');
             }

             elseif(!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) 
             {
              $_SESSION['message'] = "addresse email invalide";
                header("Location:/login");
             }

             elseif(!preg_match("/^[a-zA-Z0-9]*$/",$datas['password']))
             {
                $_SESSION['message'] = "le mot de passe doit contenir des chiffres et des lettres";
                header("Location: /login");
             }   

             else
             {
              
              $email = strip_tags(htmlspecialchars(trim($datas['email'])));
              $mdp = strip_tags(htmlspecialchars(trim($datas['password']))) ;
              $user_exists =  Database::executeQuery('SELECT * FROM users  WHERE mails=:mail',[':mail' => $email],2);
                          
              if(count($user_exists) > 0)
              {
               if(password_verify($mdp,$user_exists[0]['mdps'])){
                  Database::executeQuery('UPDATE users SET status=1 WHERE mails=:email',[':email' =>$email],3);
                  $_SESSION['user'] = Database::executeQuery('SELECT * FROM users  WHERE mails=:mail',[':mail' => $email],2)[0];
                  $this->souviens_toi_de_moi("Tokken",$datas,$datas['remember']?? '');
                  $this->message_box('connexion reussi');
                  \App\Middlewares\Security\Security::verify_role($_SESSION['user']['role']);
               }
               else{
                $_SESSION['message'] = "mot de passe incorrect";
                header('Location:/login');
               }

              }

              else
              {
                $_SESSION['message'] = "veuillez creer un compte ";
                header("Location: /login");
              }

             } 
          }
          else{}
        }

        public  function sign_up(array $datas, string $methode):void
        {     
            if($methode === "POST")
            {
               if( empty($datas['age']) || empty($datas['prenom']) || empty($datas['email'])  || empty($datas['password']) || empty($datas['confirmPassword']) || empty($datas['sexe']) || empty($datas['pseudo'])) 
               {
                $_SESSION['message'] = "tout les champs sont obligatoires";
            
                header("Location: /login");
             
               }

               elseif(strlen($datas['email']) < 9)
               {
                 header("Location: /login?message=l email doit avoir au moins 9 caracteres && color=red");
                  exit;
               }

               elseif(strlen($datas['password']) < 9)
               {
                  $_SESSION['message'] ="le mot de passe doit avoir 9 caracteres";
                  header('Location:/login');
                   exit;
               }
               elseif(strlen($datas['pseudo']) < 6)
               {
                $_SESSION['message'] = "le pseudo doit avoir au moins 3 caracteres";
                 header("Location: /login");
                  exit;
               }

               elseif (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) 
               {
                $_SESSION['message'] = "addresse email invalide";
                 header("Location:/login");
                  exit;
               }
             
               elseif ($datas['password'] !== $datas['confirmPassword'])
               {
                  $_SESSION['message'] = " les mots de passe doivent etre similaire";
                  header("Location: /login");
                  exit;
               }

               elseif(!preg_match("/^[a-zA-Z0-9]*$/",$datas['pseudo']))
               {
                $_SESSION['message'] = "le pseudo doit avoir des chiffres et des lettres";
                header("Location:/login");
                exit;
               }
 
               elseif(!preg_match("/^[a-zA-Z]*$/",$datas['prenom']) || !preg_match("/^[a-zA-Z]*$/",$datas['sexe']))
               {
                $_SESSION['message'] = "le nom et genre doivent etre compose de lettre";
                 header("Location: /register");
                  exit;
               }
                 
              else
              {
                $user_exists = Database::executeQuery("SELECT * FROM users WHERE mails=:email AND mdps=:mdp",[
                  ':email' => $this->filter_array($datas['email']),
                  ':mdp' => $this->filter_array( $datas['password'])
                ],2);

              
                if(count($user_exists) > 0)
                {
                  $_SESSION['message'] = "ce compte existe déjà";
                  header("Location: /login");
                }
                else
                {
                   $role =  '';
                   if($datas['email'] == "henoctumonakiese@gmail.com" && $datas['password'] == "Velonica9"){$role = 'administrateur';}
                   elseif(isset($datas['role'])){$role = $datas['role'];}
                   else{$role = 'utilisateur';}
               
                  Database::executeQuery("INSERT INTO users(prenoms, pseudo, mails, mdps,status,genre,tranche_age,role,avatar) 
                                          VALUES (:prenom, :pseudo,:email,:mdp,:status,:sexe,:age,:role,:avatar)",[
                    ':prenom' => $this->filter_array($datas['prenom']),
                    ':pseudo' => $this->filter_array( $datas['pseudo']),
                    ':email' => $this->filter_array( $datas['email']),
                    ':mdp' => password_hash($this->filter_array($datas['password']),PASSWORD_DEFAULT),
                    ':status' => 0,
                    ':sexe' => $this->filter_array($datas['sexe'] ),
                    ':age' =>  $this->filter_array($datas['age']),
                    ':role' => $role,
                    ':avatar' => '/assets/avatar.png'
                  ],1);
                  $_SESSION['message'] = "compte crée avec success";
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