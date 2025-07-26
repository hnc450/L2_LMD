<?php 
    namespace App\Controllers\Action;
    use App\Models\Database\Database;
  

    class Action
    {
        public static function check_existence(string $table, string $column, mixed $value):bool
        {
            try {
                $params = [':valeur' => $value];
                
                return count(Database::executeQuery("SELECT * FROM $table WHERE $column=:valeur", $params,2)) > 0 ? true :false;
            } 
            catch (\PDOException $e) {
                error_log("Erreur lors de la vérification de l'existence: " . $e->getMessage());
                return false;
            }
        }
        
        /**
         * Filtre une table en fonction d'une valeur donnée.
         *
         * @param string $table Le nom de la table à filtrer.
         * @param mixed $value La valeur à utiliser pour le filtrage.
         * @return array Un tableau contenant les résultats filtrés.
         */
        public static function filtrer_table_by_key(string $table, mixed $value):array
        { 
            $column = "";
        
            if(preg_match("/^[a-zA-z]$/",$value))
            {
                 $column = "prenoms";
                 return  Database::QueryRequest("SELECT * FROM $table WHERE $column LIKE '%$value%'",2);
            }

            elseif(preg_match("/^\d+$/",$value))
            {
                $column = "id_user";
                return  Database::QueryRequest("SELECT * FROM $table WHERE $column LIKE $value",2);
            }

            // elseif(is_bool($value))
            // {
            //      $value = $value ? 1 : 0;
            //      $column = "status";
            //      return  Database::QueryRequest("SELECT * FROM $table WHERE $column LIKE $value",2);
            // }

            // elseif(filter_var($value,FILTER_VALIDATE_EMAIL))
            // {
            //     $column = "mails";
            //     return  Database::QueryRequest("SELECT * FROM $table WHERE $column LIKE '%$value%'",2);
            // }

            // elseif(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/",$value))
            // {
            //     $column = "peusdo";
            //     return  Database::QueryRequest("SELECT * FROM $table WHERE $column LIKE '%$value%'",2);
            // }

            else
            {
              return  [];
            }
            
        }
    }

?>