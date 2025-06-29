<?php 
  namespace App\Controllers\App;
  
  use Parsedown;

 class App
 {
   private $parsedown;
   private static $app;

      public  function Parsedown():Parsedown
      {
            if(is_null($this->parsedown))
            {
                $this->parsedown = new Parsedown();
            }
            return $this->parsedown;
      }

      public static function App():App
      {
            if(is_null(static::$app))
            {
                static::$app = new App();
            }
            return static::$app;
      }


}
?>