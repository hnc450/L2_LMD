<?php 
 namespace App\Models\Jeu;
   class Jeu
   {
      public static function recuperer_tous_les_jeux()
      {
         $query = "SELECT jeux.*,categories.categorie as categorie FROM
          jeux INNER JOIN categories ON jeux.id_categorie = categories.id_categorie";
         return \App\Models\Database\Database::QueryRequest($query,2);
      }

      public static function recuperer_un_jeu($id)
      {
         $query = "SELECT jeux.*,categories.categorie as categorie FROM
          jeux INNER JOIN categories ON jeux.id_categorie = categories.id_categorie WHERE jeux.id_jeu = :id";
         return \App\Models\Database\Database::executeQuery($query,[':id' => $id],2);
      }
   }
?>