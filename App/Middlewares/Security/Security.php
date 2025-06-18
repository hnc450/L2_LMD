<?php 
    namespace App\Middlewares\Security;
    class Security
    {
        private static function is_empty(mixed $value):bool
        {
            return empty($value) ? true : false;
        }
        
        public static function security()
        {

        }
        
        public static function verify_role(string $role)
        {

            if($role === 'administrateur')
            {
                header("Location: /administration/dashboard");
                exit;
            }
            else
            {
                header("Location: /user/home");
                exit;
            }
        }
    }
?>