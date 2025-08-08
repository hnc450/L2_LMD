<?php 
    use Route\Route;

    Route::post('/sign', function() {
      \App\Controllers\Formulaire\Formulaire::instance()->sign_in($_POST,$_SERVER['REQUEST_METHOD']);
    });
    
    Route::post('/register', function() {
        \App\Controllers\Formulaire\Formulaire::instance()->sign_up($_POST,$_SERVER['REQUEST_METHOD']);
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
      //  \App\Middlewares\Security\Security::require_role('administrateur');
        \App\Controllers\Admin\Admin::add_module($_POST);
    });
    
    Route::post('/administration/ban/user/[i:id]', function($id) {
        \App\Controllers\Admin\Admin::banir_utilisateur((int)$id['id']);
    });

    Route::post('/admin/add/user',function(){
       \App\Controllers\Admin\Admin::add_user($_POST);
    });
    Route::post('/administration/add/settings',function(){
        // var_dump($_POST);
        \App\Controllers\Admin\Admin::save_admin_setting($_POST['setting_name'], $_POST['setting_value'],$_POST['id']);
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

    Route::post('/administration/edit/user/[i:id]',function($id){
        \App\Controllers\Admin\Admin::update_user($_POST,(int)$id['id']);
    });

    Route::post('/valide/tokken',function(){
        $i = 0;

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

    Route::post('/jeu/get/point',function(){
           header('Content-Type: application/json');

           $data = json_decode(file_get_contents('php://input'), true);
           \App\Controllers\FactoryController::getController('Game')->userInGame((int)$_SESSION['user']['id_user']);
           $question = $data['question'];
           $reponse = $data['reponse'];
           $bonne_reponse = \App\Models\QuestionModel::getReponse($question);

           if($reponse == $bonne_reponse){
              $points = (new \App\Controllers\GameController())->addPoint($question, $reponse);
             $data = [
               'status' => 'success',
               'message' => 'reponse correct !',
            
             ];
            echo  json_encode($data);

           } else {
             $data = [
               'status' => 'error',
               'message' => ' reponse incorrect !'
             ];
            echo  json_encode($data);
           }
    });

    Route::post('/leave/game',function(){
        echo json_encode([
            'message' => 'partie quitté avec success'
        ]);
    });

    Route::post('/finish/game',function(){
        \App\Controllers\FactoryController::getController('Game')->finishGame();
        echo json_encode([
            '' => ''
        ]);
    });

    Route::post('/deconnexion/[i:id]',function($id) use($view){
      App\Controllers\User\User::se_deconnecter((int)$id['id']);
    });

    Route::post('/administration/module/[i:id]',function($id){
        \App\Controllers\Admin\Admin::supprimer_module((int)$id['id']);
    })
?> 
