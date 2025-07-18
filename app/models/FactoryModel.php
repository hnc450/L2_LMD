<?php 
    namespace App\Models;
   
    class FactoryModel{

        public static function Factory($class)
        {
            $class = "App\\Models\\".ucfirst($class)."Model"."\\".ucfirst($class)."Model";
            return new $class();
        }
    }
?>