<?php
  session_start();
  require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
  
 // use App\Models\Database\Database; 
  use AltoRouter as Router;
  use App\Controllers\App\App;

  $routes = new Router();
  //$databse = new Database("mysql:host","3306","QuizWorld","root","");
  App::App()->getDb();

  require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php';
 Route\Route::matcher();
var_dump($_SESSION)
?>

