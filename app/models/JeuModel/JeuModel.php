<?php 
 namespace App\Models\JeuModel;
   class JeuModel
   {
      // Modèle JeuModel amélioré : gestion CRUD, validation, typage strict

      /**
       * Crée un nouveau jeu dans la base de données.
       */
      public static function create(array $data): bool
      {
          if (!self::validate($data)) return false;
          return \App\Models\Database\Database::executeQuery(
              'INSERT INTO jeux (titre, age, duration, description, id_categorie) VALUES (:titre, :age, :duration, :description, :id_categorie)',
              [
                  ':titre' => $data['titre'],
                  ':age' => $data['age'],
                  ':duration' => $data['duration'],
                  ':description' => $data['description'],
                  ':id_categorie' => $data['id_categorie'],
              ],
              1
          );
      }

      /**
       * Récupère un jeu par son ID.
       */
      public static function getById(int $id): ?array
      {
          $result = \App\Models\Database\Database::executeQuery('SELECT * FROM jeux WHERE id_jeu = :id', [':id' => $id], 2);
          return $result;
      }

      /**
       * Récupère tous les jeux.
       */
      public static function getAll(): array
      {
          $query = "SELECT jeux.*,categories.categorie as categorie FROM jeux INNER JOIN categories ON jeux.id_categorie = categories.id_categorie";
          return \App\Models\Database\Database::QueryRequest($query,2);
      }
      public static function getJeu(){
         return \App\Models\Database\Database::QueryRequest('SELECT id_jeu, titre FROM jeux ',2);
      }

      /**
       * Met à jour un jeu existant.
       */
      public static function update(int $id, array $data): bool
      {
          return \App\Models\Database\Database::executeQuery(
              'UPDATE jeux SET titre = :titre, age = :age, duration = :duration, description = :description, id_categorie = :id_categorie WHERE id_jeu = :id',
              [
                  ':titre' => $data['titre'],
                  ':age' => $data['age'],
                  ':duration' => $data['duration'],
                  ':description' => $data['description'],
                  ':id_categorie' => $data['id_categorie'],
                  ':id' => $id,
              ],
              3
          );
      }

      /**
       * Supprime un jeu par son ID.
       */
      public static function delete(int $id): bool
      {
          return \App\Models\Database\Database::executeQuery('DELETE FROM jeux WHERE id_jeu = :id', [':id' => $id], 4);
      }

      /**
       * Valide les données d'un jeu (exemple simple).
       */
      public static function validate(array $data): bool
      {
          return !empty($data['titre']) && !empty($data['age']) && !empty($data['duration']) && !empty($data['description']) && !empty($data['id_categorie']);
      }

      public function see_one(int $id)
      {
         return \App\Models\Database\Database::executeQuery('SELECT jeux.*,categories.categorie as categorie FROM jeux INNER JOIN categories 
         ON jeux.id_categorie = categories.id_categorie
         WHERE id_jeu=:id',[':id' => $id],2);

      }

      public static function recuperer_un_jeu($id)
      {
         $query = " SELECT
          questions.*, 
           jeux.id_jeu,
           jeux.titre,
           jeux.age,
           jeux.duration,
           jeux.description,
           categories.categorie
         
           FROM jeux INNER JOIN questions ON jeux.id_jeu = questions.id_jeu
           INNER JOIN categories ON jeux.id_categorie = categories.id_categorie
           WHERE jeux.id_jeu = :id;
         ";
         return \App\Models\Database\Database::executeQuery($query,[':id' => $id],2);
      }
   }

?>