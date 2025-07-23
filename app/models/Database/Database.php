<?php
    namespace App\Models\Database;
    class Database
    {
       private  static $connexion;
       private  static string $dns;
       private  static string $port;
       private  static string $database;
       private static string $user;
       private static string $password;
       private static mixed $statement;
       private static  $instance = null;
       private string $query = '';


       public function __construct(string $dns, string $port, string $database,string $user,string $password)
       {
          self::$dns = $dns;
          self::$database = $database;
          self::$port = $port;
          self::$user = $user;
          self::$password = $password;

          try
          {
           self::$connexion = new \PDO(self::$dns."=localhost:".self::$port.";dbname=".self::$database,self::$user,self::$password);
           self::$connexion->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
          }
          catch(\PDOException $exception)
          {
             die('Erreur de connexion '.$exception->getMessage());
          }
       }

      public function getQuery()
       {
         echo $this->query;
       }

       public static function setNewDatabase(string $database):void
       {
            self::$database = $database;
       }

       public static function getDatabase():string
       {
         return self::$database;
       }
       
       public static function QueryRequest(string $sql,int $option)
       {
         switch($option){
            case 1:
               self::$connexion->query($sql);
            break;
               case 2:
                  try
                  {
                     return self::$connexion->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
                  }
                  catch(\PDOException $exception)
                  {
                     die($exception->getMessage());
                  }
                  break;

            case 3:
                self::$connexion->query($sql);
               break;

            case 4:
               self::$connexion->query($sql);
            break;
         }

       }

     /**
      * 
      * @param string $sql : requete sql a inserer avec les cles
      * @param array $params : cle et valeur dans le tableau
      * exemple : [':id' => $id];
     */
  
       /**
        * 
        * @param string $sql : requete sql a inserer avec les cles
        * @param array $params : cle et valeur dans le tableau
        * exemple : [':id' => $id];
        * @param int $option : 1 pour insert, 2 pour select, 3 pour update, 4 pour delete
        */

       public static function  executeQuery(string $sql,array $params,int $option)
       {
         switch($option)
         {
            case 1:
               self::$statement = self::$connexion->prepare($sql);
               self::$statement->execute($params);
            break;
            
            case 2:
               self::$statement = self::$connexion->prepare($sql);
               self::$statement->execute($params);
               return self::$statement->fetchAll(\PDO::FETCH_ASSOC);
               break;
            case 3:
               self::$statement = self::$connexion->prepare($sql);
               self::$statement->execute($params);
               break;
            case 4:
               self::$statement = self::$connexion->prepare($sql);
               self::$statement->execute($params);
               break;
         }

       }

       public static function insert(string $generic_table_with_column,array $datas)
       {
         self::executeQuery("INSERT INTO ".$generic_table_with_column." VALUES (".str_repeat('?,', count($datas) - 1)."?)", $datas, 1);
       }

       public static function Database($dns,$port,$db,$user,$mdp):Database{
           if(is_null(static::$instance)){
              static::$instance = new Database($dns,$port,$db,$user,$mdp);
           }
           return static::$instance;
       }

       public function select(){
         $this->query .="SELECT";
         return $this;
       }

       public function all(){
         $this->query .=" * ";
           return $this;
       }

      public function column(string $column){
            $this->query .=" ".$column;
          return $this;
      }

      public function from(string $table){
         $this->query .=" FROM ".$table;
         return $this;  
       }
       public function run(int $option){
         return Database::QueryRequest($this->query,$option);
       }

       public function where(){
         $this->query .= ' WHERE ';
         return $this;
       }

       public function and(){
         $this->query .= ' AND ';
         return $this;
       }

      public function or()
      {
         $this->query .= ' OR ';
         return $this;
      }
         
         public function equal(string $column, string $value)
         {
            $this->query .= $column . ' = ' . $value;
            return $this;
         }
   
         public function like(string $column, string $value)
         {
            $this->query .= $column . ' LIKE ' . $value;
            return $this;
         }
   
         public function orderBy(string $column, string $order = 'ASC')
         {
            $this->query .= ' ORDER BY ' . $column . ' ' . strtoupper($order);
            return $this;
         }

         public function limit(int $limit)
         {
            $this->query .= ' LIMIT ' . $limit;
            return $this;
         }

         public function offset(int $offset)
         {
            $this->query .= ' OFFSET ' . $offset;
            return $this;
         }

         public function groupBy(string $column)
         {
            $this->query .= ' GROUP BY ' . $column;
            return $this;
         }
         
         public function having(string $condition)
         {
            $this->query .= ' HAVING ' . $condition;
            return $this;
         }


    }
?>
