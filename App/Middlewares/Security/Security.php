<?php 
    namespace App\Middlewares\Security;
    class Security
    {
        private static function is_empty(mixed $value):bool
        {
            return empty($value) ? true : false;
        }
        
        // public static function security()
        // {

        // }
        public static function verify_role($roles)
        {
            if($roles === 'administrateur')
            {
                header('Location: /administration/dashboard');
                exit;
            }
            else
            {
                header('Location: /user/home');
                exit;
            }
        }
        
        /**
         * Vérifie si l'utilisateur est connecté. Redirige vers /login sinon.
         */
        public static function require_auth() {
            if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
                header('Location: /login');
                exit;
            }
        }

        /**
         * Vérifie le rôle de l'utilisateur connecté. Redirige selon le rôle.
         * @param string|array $roles Rôle ou liste de rôles autorisés (ex: 'administrateur' ou ['administrateur','joueur'])
         */
        public static function require_role($roles) {
            self::require_auth();
            $userRole = $_SESSION['user'][0]['role'] ?? null;
            if (is_array($roles)) {
                if (!in_array($userRole, $roles)) {
                    header('Location: /login');
                    exit;
                }
            } else {
                if ($userRole !== $roles) {
                    header('Location: /login');
                    exit;
                }
            }
        }
    }
?>