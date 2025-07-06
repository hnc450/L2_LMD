<?php

namespace App\Models\Category;

class Category
{
    private string $id;
    private string $categorie;
    private string $slug;
    
    public static function categories():array
    {
        return \App\Models\Database\Database::QueryRequest("SELECT * FROM categories", 2);
    }
}

?>