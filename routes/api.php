<?php 
   use Route\Route;

   Route::get('/api/categories',function(){
       header('Content-Type: application/json');
      echo json_encode(\App\Models\Category\Category::categories(),JSON_PRETTY_PRINT);
   });

   Route::get('/api/exploration/[i:id]',function($id){
     header('Content-Type: application/json');
     echo json_encode(\App\Models\Exploration\Exploration::getById($id['id']) ?? ['void'=> 'void'],JSON_PRETTY_PRINT);
   });

   Route::get('/api/jeu/[i:id]',function($id){
      header('Content-Type: application/json');
      echo json_encode(\App\Models\JeuModel\JeuModel::recuperer_un_jeu($id['id']) ??['void' => 'void'],JSON_PRETTY_PRINT);
   });

   Route::get('/api/game/[i:id]',function($id){
      header('Content-Type: application/json');
  
       echo json_encode(\App\Models\FactoryModel::Factory('Jeu')->see_one((int)$id['id']));
   });

   Route::get('/api/module/[i:id]',function($id){
        header('Content-Type: application/json');
        return[
            'message' => 'let s go'
        ];
   });

   Route::get('/chat/messages',function(){
       $messages = \App\Controllers\User\User::recuperer_messages();
       header("Access-Control-Allow-Headers: Content-Type, Authorization");
       header('Content-Type: application/json');
       echo json_encode($messages);
   });

   Route::get('/chat/online-users',function(){
       header('Content-Type: application/json');
       echo json_encode(\App\Controllers\User\User::get_online_users());
   });
?>