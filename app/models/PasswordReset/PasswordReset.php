<?php 
    namespace App\Models\PasswordReset;

    class PasswordReset
    {
        private $email;
        private $tokken;
        private $time;
        private static $instance;

        public function __construct($email)
        {
            $this->email = $email;
            $this->tokken = random_int(100000, 999999);
            $this->time = 300000;
        }

        public  static function instancePasswordReset($email):PasswordReset{
            if(is_null(static::$instance)){
                static::$instance = new PasswordReset($email);
            }
            return static::$instance;
        }



        public function insertTokken(){

            \App\Models\Database\Database::executeQuery('INSERT INTO password_resets(email,token,expire_date)
            VALUES(:mail,:tokken,:expire)
            ',
            [
                ':mail'=> $this->email,
                ':tokken' => $this->tokken,
                ':expire' => $this->time
            ]
            , 1);
            \Messages\Messages::getInstance()->success('Code de recuperation',$this->email,\App\Models\Database\Database::executeQuery('SELECT prenoms FROM users WHERE mails=:mail',[':mail'=>$this->email],2)[0]['prenoms'],(string)$this->tokken);
            header("Location:/reset/password?m={$this->email}");
        } 

        private function returnTokken($tokken){
            return \App\Models\Database\Database::executeQuery('SELECT * FROM password_resets WHERE token=:tokken',[':tokken' => $tokken],2);
        }

        public function valideTokken($tokken){
          $validity = $this->returnTokken($tokken);

          if(count($validity) > 0){
            echo "tokken valide";
            header("Location:/update/password?m={$this->email}");
          }
          //header('Location: /');
        }
    }
?>