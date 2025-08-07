<?php
namespace App\Models\Exploration;

use App\Models\Database\Database;

class Exploration
{
    private static $instance; // Instance unique de la classe Exploration

    // Créer une exploration
    /**
     * Crée une nouvelle exploration dans la base de données.
     * 
     * @param string $titre Le titre de l'exploration.
     * @param string $slug Le slug de l'exploration.
     * @param string $categorie_id L'ID de la catégorie de l'exploration.*/
    public static function create(string $titre, string $slug, string $categorie_id,string $contenu,string $description)
    {
        $query = "INSERT INTO explorations (category_id, titre_exploration , description_exploration,contenu_exploration,slug_exploration)
         VALUES (:categorie,:titre, :descrip,:content,:slug)";
        $params = [
            ':categorie' => $categorie_id,
            ':titre' => $titre,
            ':descrip' => $description,
            ':content' => $contenu,
            ':slug' => $slug
        ];
        Database::executeQuery($query, $params, 1);
    }
    
   // Récupérer l'instance de la classe Exploration
    /**
     * Récupère l'instance unique de la classe Exploration.
     * 
     * @return Exploration L'instance unique de la classe Exploration.
     */
    // Récupérer l'instance de la classe Exploration
    /**
     * Récupère l'instance unique de la classe Exploration.
     * 
     * @return Exploration L'instance unique de la classe Exploration.
     */
    public static function getInstanceExploration():Exploration{
          if(is_null(self::$instance))
          {
                self::$instance = new Exploration();
                return static::$instance;
          }
          return self::$instance;
    }

    // Lire toutes les explorations
    public static function getAll()
    {
        $query = "SELECT  explorations.id_exploration as id,
                 explorations.titre_exploration as titre,
                 explorations.description_exploration as description,
                 explorations.slug_exploration as slug ,
                 categories.categorie 
                 FROM categories INNER JOIN explorations 
                 ON explorations.category_id = categories.id_categorie
                 ORDER BY explorations.id_exploration ASC
        ";
        return Database::QueryRequest($query, 2); 
    }

    // Lire toutes les explorations d'un utilisateur
    public static function getByUser($user_id)
    {
        $query = "SELECT * FROM explorations WHERE user_id = :user_id";
        $params = ['user_id' => $user_id];
        return Database::QueryRequest($query, 2);
    }

    // Lire une exploration par ID
    public static function getById($id)
    {
        $query = "SELECT * FROM explorations WHERE id_exploration =:id";
        $params = [':id' => $id];
        return Database::executeQuery($query,$params,2);
    }

    // Mettre à jour une exploration (avec vérification user_id)
    public static function update($id, $titre, $categorie, $info, $user_id)
    {
        $query = "UPDATE explorations SET titre_exploration = :titre, categorie = :categorie, info = :info WHERE id = :id AND user_id = :user_id";
        $params = [
            ':id' => $id,
            ':titre' => $titre,
            ':categorie' => $categorie,
            ':info' => $info,
            ':user_id' => $user_id
        ];
        return Database::executeQuery($query, $params, 1);
    }

    // Supprimer une exploration (avec vérification user_id)
    public static function delete($id)
    {
        $query = "DELETE FROM explorations WHERE id_exploration=:id";
        $params = ['id' => $id];
        return Database::executeQuery($query, $params, 4);
    }


} 