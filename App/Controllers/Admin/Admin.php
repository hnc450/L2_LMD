<?php
    namespace App\Controllers\Admin;
    use App\Controllers\Action\Action;
    use App\Models\Database\Database;
    use App\Controllers\User\User;
    
    class Admin extends User
    {
        public static function delete_user_by_id(int $user_id) 
        {
            try {
               
                if(!is_numeric($user_id) || $user_id <= 0){
                    return false;
                }
             
                $query = "DELETE FROM users WHERE id_user = $user_id";
                $result = Database::QueryRequest($query, 4);
                header("Location: /admin/dahsboard");
                
            } catch (\PDOException $e) {
              
                error_log("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
                return false;
            }
        }
        
        public static function get_all_users() 
        {
            try {
                $query = "SELECT * FROM users";
                $result = Database::QueryRequest($query, 2);
                return $result;
            } catch (\PDOException $e) {
                error_log("Erreur lors de la récupération des utilisateurs: " . $e->getMessage());
                return [];
            }
        }
        /**
         * Récupère un utilisateur par son identifiant.
         *
         * @param mixed $tag L'identifiant de l'utilisateur.
         * @return array|false Les données de l'utilisateur ou false en cas d'erreur.
         */
        public static function get_user_by_tag(mixed $tag) 
        {
            try {
              return Action::filtrer_table_by_key("users", $tag);
            } catch (\PDOException $e) {
                error_log("Erreur lors de la récupération de l'utilisateur: " . $e->getMessage());
                return [];
            }
        }

        public static function ajouter_un_jeu(array $datas , string $methode) 
        {
            if($methode ==="POST")
            {

            }
            else
            {
                header("Location: /home");
            }
        }
        
        public static function ajouter_un_exploration(array $datas , string $methode) 
        {
            if($methode ==="POST")
            {

            }
            else
            {
                header("Location: /home");
            }
        }

    }

?>
