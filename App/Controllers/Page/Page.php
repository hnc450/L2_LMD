<?php
  namespace App\Controllers\Page;

  class Page
  {
    public static function getPage(string $page)
    {
      //echo  explode('?',$page)[0];
      if (file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . $page.".php"))
      {
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . $page.".php";
      }
      else 
      {
        return;
      }
    }

    public static function getPageWithId(string $page, mixed $value)
    {
    
      if (file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . $page.".php"))
      {
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . $page.".php";
      }
      else 
      {
        return;
      }
    }

  }
?>