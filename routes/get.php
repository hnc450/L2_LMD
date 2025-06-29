<?php 
    use Route\Route;

    Route::get('/',function(){
        \App\Controllers\Page\Page::getPage('welcome');
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

    Route::get('/user/profile',function(){
      \App\Controllers\Page\Page::getPage('profile');
    });

    Route::get('/login',function(){
      \App\Controllers\Page\Page::getPage('login');
    });
?>