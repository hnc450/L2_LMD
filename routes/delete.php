<?php
use Route\Route;

Route::delete('/delete/account/[i:id]',function($id){
   header('Content-Type: application/json');
   \App\Controllers\User\User::supprimer_mon_compte((int)$id['id']);
 
  echo json_encode(["success" => true, "message" => "Compte supprimé avec succès."]);
});

Route::delete('/administration/quiz/[i:id]', function($id) {
    //\App\Middlewares\Security\Security::require_role('administrateur');
    \App\Controllers\Admin\Admin::supprimer_jeu((int)$id['id']);
});

Route::delete('/administration/category/[i:id]', function($id) {
    //\App\Middlewares\Security\Security::require_role('administrateur');
    \App\Controllers\Admin\Admin::supprimer_une_categorie((int)$id['id']);
});

Route::delete('/administration/delete/user/[i:id]', function($id) {
    //\App\Middlewares\Security\Security::require_role('administrateur');
    \App\Controllers\Admin\Admin::delete_user_by_id((int)$id['id']);
});

Route::delete('/user/explorations/[i:id]', function($id) {
    \App\Middlewares\Security\Security::require_role('joueur');
    \App\Controllers\User\User::supprimer_exploration((int)$id['id']);
});

Route::delete('/administration/module/[i:id]', function($id) {
    \App\Middlewares\Security\Security::require_role('administrateur');
    //\App\Controllers\Admin\Admin::supprimer_module((int)$id['id']);
});

Route::delete('/administration/exploration/[i:id]', function($id) {
    //\App\Middlewares\Security\Security::require_role('administrateur');
    \App\Controllers\Admin\Admin::supprimer_exploration((int)$id['id']);
});

Route::delete('/user/delete/avatar', function() {
    if(isset($_SESSION['user'][0]['id_user'])) {
        \App\Controllers\User\User::supprimer_avatar($_SESSION['user'][0]['id_user']);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Non autorisé']);
    }
});

Route::delete('/administration/settings/[i:id]', function($id) {
    //\App\Middlewares\Security\Security::require_role('administrateur');
    \App\Models\SettingModel::deleteSetting((int)$id['id']);
});
?>