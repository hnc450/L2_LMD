<?php
namespace App\Models\Exploration;

use App\Models\Database\Database;

class Exploration
{
    // Créer une exploration
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
        $query = "SELECT * FROM explorations WHERE id = :id";
        $params = ['id' => $id];
        return Database::QueryRequest($query, 2);
    }

    // Mettre à jour une exploration (avec vérification user_id)
    public static function update($id, $titre, $categorie, $info, $user_id)
    {
        $query = "UPDATE explorations SET titre = :titre, categorie = :categorie, info = :info WHERE id = :id AND user_id = :user_id";
        $params = [
            'id' => $id,
            'titre' => $titre,
            'categorie' => $categorie,
            'info' => $info,
            'user_id' => $user_id
        ];
        return Database::executeQuery($query, $params, 1);
    }

    // Supprimer une exploration (avec vérification user_id)
    public static function delete($id, $user_id)
    {
        $query = "DELETE FROM explorations WHERE id = :id AND user_id = :user_id";
        $params = ['id' => $id, 'user_id' => $user_id];
        return Database::executeQuery($query, $params, 4);
    }
} 