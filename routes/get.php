<?php 
    use Route\Route;

    Route::get('/',function(){
        \App\Controllers\Page\Page::getPage('welcome');
    });

    Route::get('/login',function(){
      \App\Controllers\Page\Page::getPage('login');
    });

    Route::get('/deconnexion',function(){
      App\Controllers\User\User::se_deconnecter();
    });
    
    Route::get('/user/chat',function(){
      \App\Controllers\Page\Page::getPage('chat');
    });

    Route::get('/user/explorations',function(){
        \App\Controllers\Page\Page::getPage('explorations');
    });

    Route::get('/user/home',function(){
       \App\Controllers\Page\Page::getPage('home');
    });

    Route::get('/user/jeux',function(){
        \App\Controllers\Page\Page::getPage('jeux');
    });

    Route::get('/user/ligue',function(){
        \App\Controllers\Page\Page::getPage('ligue');
    });

    Route::get('/user/modules',function(){
       \App\Controllers\Page\Page::getPage('modules');
    });

    Route::get('/user/parametres',function(){
        \App\Controllers\Page\Page::getPage('parametres');
    });

    Route::get('/user/profile',function(){
      \App\Controllers\Page\Page::getPage('profile');
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

    Route::get('/administration/dashboard',function(){
      \App\Controllers\Page\Page::dashboard('dashboard');
    });

    Route::get('/administration/plaintes',function(){
         \App\Controllers\Page\Page::dashboard('plaintes');
    });

    Route::get('/administration/users',function(){
       \App\Controllers\Page\Page::dashboard('users');
    });

    Route::get('/administration/contenus',function(){
        \App\Controllers\Page\Page::dashboard('contenu');
    });

    Route::get('/administration/ligue',function(){
         \App\Controllers\Page\Page::dashboard('ligues');
    });

    Route::get('/administration/settings',function(){
           \App\Controllers\Page\Page::dashboard('parametres');
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

   
?>