<?php
   
   use Route\Route;
   
   Route::put('/administration/quiz/[i:id]', function($id) {
       // \App\Middlewares\Security\Security::require_role('administrateur');
       $datas = json_decode(file_get_contents('php://input'), true);
       \App\Controllers\Admin\Admin::modifier_jeu((int)$id['id'], $datas, $_SERVER['REQUEST_METHOD']);
   });
   
   Route::put('/user/explorations/[i:id]', function($id) {
       \App\Middlewares\Security\Security::require_role('joueur');
       \App\Controllers\User\User::modifier_exploration($_POST, $_SERVER['REQUEST_METHOD'], (int)$id['id']);
   });
   
   Route::put('/administration/module/[i:id]', function($id) {
       \App\Middlewares\Security\Security::require_role('administrateur');
       // \App\Controllers\Admin\Admin::modifier_module($_POST, $_SERVER['REQUEST_METHOD'], (int)$id['id']);
   });
   
   Route::put('/administration/exploration/[i:id]', function($id) {
       \App\Middlewares\Security\Security::require_role('administrateur');
       $datas = json_decode(file_get_contents('php://input'), true);
       \App\Controllers\Admin\Admin::modifier_exploration($datas, $_SERVER['REQUEST_METHOD'], (int)$id['id']);
   });

   Route::put('/update/password',function(){

   });
?>