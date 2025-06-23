<?php

namespace App\Models\Category;

class Category
{
 
    public static function categories():array
    {
        return \App\Models\Database\Database::QueryRequest("SELECT * FROM categories", 2);
    }
}

?>