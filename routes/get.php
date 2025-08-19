<?php 
    use Route\Route;
  
    Route::get('/',function() use ($view){
      $view->welcome();
    });

    Route::get('/login',function() use ($view){
       $view->login();
    });
  
    Route::get('/user/chat',function() use($view){
       $view->chat();
    });

    Route::get('/user/explorations',function() use($view){
        $view->explorations();
    });

    Route::get('/user/home',function() use($view){
        $view->home();
    });

    Route::get('/user/jeux',function() use($view){
        $view->jeux();
    });

    Route::get('/user/ligue',function() use($view){
        $view->ligue();
    });

    Route::get('/user/modules',function() use($view){
       $view->modules();
    });

    Route::get('/user/parametres',function() use($view){
        $view->setting();
    });

    Route::get('/user/profile',function() use($view){
      $view->profile();
    });

    Route::get('/user/jeu/[i:id]',function($id) use($view){
        $view->game((int)$id['id']);
    });


    Route::any('/user/start/module/[i:id]',function($id) use($view){
        $view->start_module((int)$id['id']);
    }, 'POST|GET');

    Route::get('/user/exploration/start/[i:id]',function($id) use($view){
        $view->start_exploration((int)$id['id']);
    }); 

    Route::get('/administration/dashboard',function() use ($view){
      $view->dashboard();
    });

    Route::get('/administration/plaintes',function() use($view){
        $view->feedbacks();
    });

    Route::get('/administration/users',function() use($view){
     // \App\Middlewares\Security\Security::verify_role($_SESSION['user']['role']);
     if($_SESSION['user']['role'] !== "administrateur"){
      header('Location: /user/home');
     }
      $view->users();
    });

    Route::get('/administration/contenus',function() use($view){
      $view->contenus();
    });

    Route::get('/administration/ligue',function() use($view){
       $view->ligues();
    });

    Route::get('/administration/settings',function() use($view){
       $view->settings();
    });

    Route::get('/administration/user/[i:id]',function($id) use ($view){
       $view->user((int)$id['id']);
    });

    Route::get('/error/[i:code]',function($error){
       \App\Controllers\Page\Page::getPageWithId('errors',$error['code']);
    });

    Route::get('/test',function(){
       \App\Controllers\Page\Page::getPage('test');
    });

    Route::get('/forget/password',function(){
      \App\Controllers\Page\Page::getPage('reset-form');
    });
    
    Route::get('/reset/password',function(){
      \App\Controllers\Page\Page::getPage('sms');
    });
    
    Route::get('/update/password',function(){
        \App\Controllers\Page\Page::getPage('mail');
    });
?>