<?php 
    namespace App\Models;
    class FactoryModel{

        public static function Factory($class)
        { 
           $class = "App\\Models\\".ucfirst($class)."Model";
          
           if(class_exists($class)){
              return new $class();
           }
        }
    }
?>