<?php

namespace App\Models\Category;

use App\Models\Database\Database;
use Exception;

class Category
{
    private ?int $id = null;
    private string $categorie;
    private string $slug;

    public function __construct(array $data = [])
    {
        if ($data) {
            $this->id = $data['id_categorie'] ?? null;
            $this->categorie = $data['categorie'] ?? '';
            $this->slug = $data['slug'] ?? '';
        }
    }

    public static function getAll(): array
    {
        return Database::QueryRequest("SELECT * FROM categories", 2);
    }

    public static function getById(int $id): ?self
    {
        $result = Database::executeQuery("SELECT * FROM categories WHERE id_categorie = :id", [':id' => $id], 2);
        return $result ? new self($result[0]) : null;
    }

    public static function create(array $data): bool
    {
        // Validation ici
        if (empty($data['categorie']) || empty($data['slug'])) {
            throw new Exception("Champs obligatoires manquants");
        }
        return Database::executeQuery(
            "INSERT INTO categories (categorie, slug) VALUES (:categorie, :slug)",
            [':categorie' => $data['categorie'], ':slug' => $data['slug']],
            1
        );
    }

    public static function update(int $id, array $data): bool
    {
        // Validation ici
        return Database::executeQuery(
            "UPDATE categories SET categorie = :categorie, slug = :slug WHERE id_categorie = :id",
            [':categorie' => $data['categorie'], ':slug' => $data['slug'], ':id' => $id],
            3
        );
    }

    public static function delete(int $id): bool
    {
        return Database::executeQuery(
            "DELETE FROM categories WHERE id_categorie = :id",
            [':id' => $id],
            4
        );
    }
}

?>