<?php
  session_start();
  require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

  use App\Models\Database\Database; 
  use AltoRouter as Route;  
  
  $routes = new Route();
  $databse = new Database("mysql:host","3306","QuizWorld","root","");
?>
   
<?php
    // if($_SERVER['REQUEST_URI'] !== "/" && $_SERVER['REQUEST_URI'] !== "/login" && $_SERVER['REQUEST_URI'] !== "/register" &&  $_SERVER['REQUEST_URI'] !== "/administration/dashboard"){
    //  require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'sidebar.php';
    // }

    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php';
?>
   

