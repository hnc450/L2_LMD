  
<?php
  session_start();
  
  require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
  
  use AltoRouter as Router;
  use App\Controllers\App\App;

  $databse = App::App()->getDb('henock','root');
  $view = \App\Controllers\Page\Page::instance();

  require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php';
  Route\Route::matcher();
?>