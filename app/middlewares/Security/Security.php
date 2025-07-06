<?php 
    namespace App\Middlewares\Security;
   

    class Security
    {
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
            $role = $_SESSION['user'][0]['role'] ?? null;
            if (is_array($roles)) {
                if (!in_array($role, $roles)) {
                    header('Location: /login');
                    exit;
                }
            } else {
                if ($role !== $roles) {
                    header('Location: /login');
                    exit;
                }
            }
        }


    }
?>