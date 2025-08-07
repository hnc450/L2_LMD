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
        $datas = json_decode(file_get_contents('php://input'), true);
        \App\Controllers\Admin\Admin::modifier_module((int)$id['id'],$datas, $_SERVER['REQUEST_METHOD']);
   });
   
   Route::put('/administration/exploration/[i:id]', function($id) {
       \App\Middlewares\Security\Security::require_role('administrateur');
       $datas = json_decode(file_get_contents('php://input'), true);
       \App\Controllers\Admin\Admin::modifier_exploration($datas, $_SERVER['REQUEST_METHOD'], (int)$id['id']);
   });

   Route::put('/reset/password/[i:id]',function($id){
    //  header('Content-Type: application/json');
      $datas = json_decode(file_get_contents('php://input'), true);
      \App\Controllers\User\User::modifier_mot_de_passe($datas, $_SERVER['REQUEST_METHOD'],$id['id']);
   });

//    Route::put('/administration/edit/user/[i:id]',function($id){
//         \App\Controllers\Admin\Admin::update_user($_POST,(int)$id['id']);
//     });   
Route::put('/settings/update', function() {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $value = $data['value'];
    // Update la BDD ici
    // Ex: UPDATE settings SET setting_value = $value WHERE id = $id
      \App\Models\SettingModel::updateSetting($id,$value);
      
});
?>