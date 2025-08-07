<?php 
  namespace App\Controllers;
  
  class FactoryController
  {
      public static function getModel($modelName)
      {
          $modelClass = "\\App\\Models\\{$modelName}Model";
          if (class_exists($modelClass)) {
              return new $modelClass();
          }
          throw new \Exception("Model {$modelName} does not exist.");
      }

      public static function getController($controllerName)
      {
        $controllerName = ucfirst($controllerName);
        try{
            $controllerClass = "\\App\\Controllers\\{$controllerName}Controller";
            if(class_exists($controllerClass)) {
                return new $controllerClass();
            }
            else{
                throw new \Exception("Controller {$controllerName} does not exist.");
            }
        }
        catch(\Exception $e){
              echo "Error: " . $e->getMessage();
          }
      }
  }
  
?>