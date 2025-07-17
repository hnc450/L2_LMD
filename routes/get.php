<?php 
    use Route\Route;

    Route::get('/',function() use ($view){
      $view->welcome();
    });

    Route::get('/login',function() use ($view){
       $view->login();
    });

    Route::get('/deconnexion',function() use($view){
      App\Controllers\User\User::se_deconnecter();
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

    Route::get('/user/jeu/[i:id]',function($id){
        \App\Controllers\Page\Page::getPage('start-game');
    });


    Route::get('/user/exploration/start/[i:id]',function($id){
       echo 
        App\Controllers\App\App::App()
       ->Parsedown()
       ->text(\App\Models\Exploration\Exploration::getById($id['id'])[0]['contenu_exploration']);
    });

    Route::get('/administration/dashboard',function() use ($view){

      $view->dashboard();
    });

    Route::get('/administration/plaintes',function() use($view){
        $view->feedbacks();
    });

    Route::get('/administration/users',function() use($view){
      //  \App\Controllers\Page\Page::dashboard('users');
        $view->users();
    });

    Route::get('/administration/contenus',function() use($view){
        $view->contenus();
    });

    Route::get('/administration/ligue',function() use($view){
        //  \App\Controllers\Page\Page::dashboard('ligues');
        $view->ligues();
    });

    Route::get('/administration/settings',function() use($view){
          //  \App\Controllers\Page\Page::dashboard('settings');
          $view->settings();
    });

    Route::get('/administration/user/[i:id]',function($id){
       \App\Controllers\Page\Page::getPageWithId('user',$id['id']);
    });

    Route::get('/error/[i:code]',function($error){
       \App\Controllers\Page\Page::getPageWithId('errors',$error['code']);
    });

    Route::get('/test',function(){
      \App\Controllers\Page\Page::getPage('sms');
    });


    Route::get('/forget/password',function(){
      \App\Controllers\Page\Page::getPage('form');
    });
    
    Route::get('/reset/password',function(){
      \App\Controllers\Page\Page::getPage('sms');
    });

    Route::get('/update/password',function(){
        \App\Controllers\Page\Page::getPage('mail');
    })
   
?>