<?php 
   namespace App\Models\ContenuModel;
   class ContenuModel
   {
     // Modèle pour gérer les contenus (ex: articles, modules, ressources, etc.)
     // Les méthodes CRUD permettent de manipuler les contenus en base de données.

     /**
      * Crée un nouveau contenu dans la base de données.
      * Utile pour ajouter un nouvel article, module, ressource, etc.
      */
     public static function create(array $data): bool
     {
         // À adapter selon la structure de la table 'contenus'
         // Exemple: titre, description, contenu, auteur_id
         return \App\Models\Database\Database::executeQuery(
             "INSERT INTO contenus (titre, description, contenu, auteur_id) VALUES (:titre, :description, :contenu, :auteur_id)",
             [
                 ':titre' => $data['titre'],
                 ':description' => $data['description'],
                 ':contenu' => $data['contenu'],
                 ':auteur_id' => $data['auteur_id']
             ],
             1
         );
     }

     /**
      * Récupère un contenu par son ID.
      * Permet d'afficher ou d'éditer un contenu précis.
      */
     public static function getById(int $id): ?array
     {
         $result = \App\Models\Database\Database::executeQuery(
             "SELECT * FROM contenus WHERE id_contenu = :id",
             [':id' => $id],
             2
         );
         return $result[0] ?? null;
     }

     /**
      * Récupère tous les contenus.
      * Utile pour afficher une liste de contenus (dashboard, page publique, etc.)
      */
     public static function getAll(): array
     {
         return \App\Models\Database\Database::QueryRequest("SELECT * FROM contenus", 2);
     }

     /**
      * Met à jour un contenu existant.
      * Permet de modifier un contenu (titre, description, etc.)
      */
     public static function update(int $id, array $data): bool
     {
         return \App\Models\Database\Database::executeQuery(
             "UPDATE contenus SET titre = :titre, description = :description, contenu = :contenu WHERE id_contenu = :id",
             [
                 ':titre' => $data['titre'],
                 ':description' => $data['description'],
                 ':contenu' => $data['contenu'],
                 ':id' => $id
             ],
             3
         );
     }

     /**
      * Supprime un contenu par son ID.
      * Utile pour retirer un contenu de la base (suppression admin, etc.)
      */
     public static function delete(int $id): bool
     {
         return \App\Models\Database\Database::executeQuery(
             "DELETE FROM contenus WHERE id_contenu = :id",
             [':id' => $id],
             4
         );
     }
   }

?>