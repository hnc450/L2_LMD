<?php 
   use Route\Route;
   header('Content-Type: application/json');

   Route::get('/api/categories',function(){
      echo json_encode(\App\Models\Category\Category::categories(),JSON_PRETTY_PRINT);
   });

   Route::get('/api/exploration/[i:id]',function($id){
 
     echo json_encode(\App\Models\Exploration\Exploration::getById($id['id']) ?? ['void'=> 'void'],JSON_PRETTY_PRINT);
   });

   Route::get('/api/jeu/[i:id]',function($id){
      echo json_encode(\App\Models\Jeu\Jeu::recuperer_un_jeu($id['id']) ??['void' => 'void'],JSON_PRETTY_PRINT);
   });

   Route::get('/api/module/[i:id]',function($id){
        return[
            'message' => 'let s go'
        ];
   })

?>