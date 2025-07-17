<?php 
    use Route\Route;

    Route::post('/sign', function() {
        \App\Controllers\Formulaire\Formulaire::sign_in($_POST, $_SERVER['REQUEST_METHOD']);
    });
    
    Route::post('/register', function() {
        \App\Controllers\Formulaire\Formulaire::sign_up($_POST, $_SERVER['REQUEST_METHOD']);
    });
    
    Route::post('/modifier/information/[i:id]', function($id) {
        \App\Controllers\User\User::modifier_information_compte($_POST, $_SERVER['REQUEST_METHOD'], (int)$id['id']);
    });
    
    Route::post('/update/password/[i:id]', function($id) {
        \App\Controllers\User\User::modifier_mot_de_passe($_POST, $_SERVER['REQUEST_METHOD'], (int)$id['id']);
    });
    
    Route::post('/administration/add/exploration', function() {
        //\App\Middlewares\Security\Security::require_role($_SESSION['user'][0]['role']);
        \App\Controllers\Admin\Admin::ajouter_un_exploration($_POST, $_SERVER['REQUEST_METHOD']);
    });
    
    Route::post('/administration/add/quiz', function() {
        //\App\Middlewares\Security\Security::require_role('administrateur');
        \App\Controllers\Admin\Admin::ajouter_un_jeu($_POST, $_SERVER['REQUEST_METHOD']);
    });
    
    Route::post('/administration/add/category', function() {
        //\App\Middlewares\Security\Security::require_role('administrateur');
        \App\Controllers\Admin\Admin::ajouter_une_categorie($_POST);
    });
    
    Route::post('/user/explorations', function() {
        \App\Middlewares\Security\Security::require_role('joueur');
        \App\Controllers\User\User::ajouter_une_exploration($_POST, $_SERVER['REQUEST_METHOD']);
    });
    
    Route::post('/administration/add/module', function() {
        \App\Middlewares\Security\Security::require_role('administrateur');
        //\App\Controllers\Admin\Admin::ajouter_un_module($_POST, $_SERVER['REQUEST_METHOD']);
    });
    
    Route::post('/administration/ban/user/[i:id]', function($id) {
        \App\Controllers\Admin\Admin::banir_utilisateur((int)$id['id']);
    });

    Route::post('/admin/add/user',function(){
        var_dump($_POST);
       \App\Controllers\Admin\Admin::add_user($_POST);
    });
    
    Route::post('/chat/send', function() {
        $user = new \App\Controllers\User\User();
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $user->envoyer_message($data['message']);
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    });
    
    Route::post('/user/profile/avatar', function() {
        \App\Controllers\User\User::modifier_profile($_SERVER['REQUEST_METHOD'], $_FILES);
    });

    Route::post('/send/mail',function(){
    \App\Models\PasswordReset\PasswordReset::instancePasswordReset($_POST['mail'])
    ->insertTokken();
    });

    Route::post('/valide/tokken',function(){
        $i = 0;
        echo "<pre>";
        var_dump($_POST['number']);
           echo "</pre>";
        $results ='';
        $tokken= '';
        while($i <= 5){
            $results .= $_POST['number'][$i];
            $i++;
        }
     
        $tokken = $results;
        echo $tokken;
        \App\Models\PasswordReset\PasswordReset::instancePasswordReset($_POST['email'])->valideTokken($tokken);
    
    });
?> 