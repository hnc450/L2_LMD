<?php
  namespace App\Controllers\Page;

  class Page
  {
     private static $instance;

     public static function instance():Page
     {
       if(is_null(static::$instance))
        {
          static::$instance = new Page();
        }
        return static::$instance;
     }

    public static function getPage(string $page)
    {
   
   
      if (file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR.'user'. DIRECTORY_SEPARATOR . $page.".php"))
      {
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR.'user'. DIRECTORY_SEPARATOR . $page.".php";
      }

      elseif (file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $page.".php")) 
      {
       require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $page.".php";
      }
      else 
      {
        return;
      }
    }

    public static function getPageWithId(string $page, mixed $value)
    {
    
      if(file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $page.".php"))
      {
        $value;
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $page.".php";
      }
      elseif(file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR.'administration'. DIRECTORY_SEPARATOR . $page.".php")){
        $value;
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR .'administration'. DIRECTORY_SEPARATOR . $page.".php";
      }
      else 
      {
        return;
      }
    }

    public  function dashboard()
    {
      $this->view('dashboard');
    }

    private function include_file(string $file)
    {
      require dirname(__DIR__,2) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $file.".php";
    }

    private function existence_file(string $file):bool{
      if(file_exists(dirname(__DIR__,2). DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $file.".php"))
      {
        return true;
      }
      return false;
    }

    private  function view($fichier){
      if($this->existence_file($fichier))
      {
          $this->include_file($fichier);
      }
    }

    private function render($fichier,$valeur){
      if($this->existence_file($fichier))
      {
          extract($valeur);
          require dirname(__DIR__,2) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $fichier.".php";
      }
    }

    public function contenus()
    {
      $this->view('contenu');
    }

    public function chat()
    {
      $this->view('chat');
    }

    public function explorations()
    {
      $this->view('explorations');
    }

    public function feedbacks()
    {
      $this->view('plaintes');
    }

    public function game($id)
    {
     $jeu =  \App\Models\Jeu\Jeu::recuperer_un_jeu($id);
      $this->render('game',compact('id','jeu'));
    }
    
    public function home()
    {
        $this->view('home');
    }

    public function jeux()
    {
      $this->view('jeux');
    }

    public function welcome()
    {  
      $this->view('welcome');
    }

    public function login()
    {
      $this->view('login');
    }

    public function ligue()
    {
        $this->view('ligue');
    }

    public function ligues()
    {
      $this->view('ligues');
    }
    public function modules()
    {
      $this->view('modules');
    }

    public function profile()
    {
      $this->view('profile');
    }
    public function settings()
    {
      $this->view('settings');
    }

    public function setting()
    {
         $this->view('setting');
    }

    public function users()
    {
          $this->view('users');
    }

    public function user($id)
    {
      $user = \App\Models\FactoryModel::Factory('User')->getUser($id);
      $this->render('user',compact('user'));
    }
  }
?>