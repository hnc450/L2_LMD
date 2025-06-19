<?php 
            use App\Models\Component\Component;
            use App\Controllers\Page\Page;
            use App\Controllers\Formulaire\Formulaire;
            use App\Controllers\User\User;
            use App\Controllers\Action\Action;
            use App\Controllers\Admin\Admin;
                
            $routes->map("GET","/test", function($action) {
                Page::getPage("mark");
            });

            $routes->map("GET","/", function() {
                Page::getPage("welcome");
            });

             /* Route for User in GET*/
            $routes->map("GET","/user/chat", function() {
                Page::getPage("chat");
            });
            $routes->map("GET","/user/home", function() {
                Page::getPage("home");
            });

            $routes->map("GET","/user/jeux", function() {
                Page::getPage("jeux");
            });
            $routes->map("GET","/user/modules",function(){
                Page::getPage("modules");
            });

            $routes->map("GET","/user/profile", function() {
                 Page::getPage("profile");
            });

            $routes->map("GET","/user/ligue", function() {
                  Page::getPage("ligue");
            });

            $routes->map("GET","/user/parametres", function() {
                Page::getPage("parametres");
            });
            
            $routes->map("GET","/user/explorations", function() {
                Page::getPage("explorations");
            });

            /*--------------*/

           /*     Route for User && Admin in GET*/
            

            $routes->map("GET","/login",function(){
                 Page::getPage("login");
            });
                     
            $routes->map("GET","/deconnexion",function(){
                User::se_deconnecter();
            });

            /*Route for Admin in GET*/ 
            // route pour voir un utilisateur

            $routes->map("GET","/administration/user/[i:id]",function($id){
              Page::getPageWithId("user",$id['id']);
            });

            $routes->map("GET","/users",function(){
               Page::getPage("utilisateurs");
            });

            // Message route à supprimer ne sert plus à rien

            // $routes->map("GET","/error/[a:message]",function($message){
            //    // echo $message['message'];
            //     //echo  "<br/>";
            //    echo str_replace("0"," ",$message['message']);
            // });

            $routes->map("GET","/delete/account/[i:id]", function($id) {
                echo Component::P($id['id'],null,"color: white; font-size: 20px;text-align: center;");
                User::supprimer_mon_compte((int)$id['id']);
            });

            $routes->map("GET","/sidebard", function() {
                Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });

            $routes->map("POST","/sign", function() {
                Formulaire::sign_in($_POST,$_SERVER['REQUEST_METHOD']);
            });

            $routes->map("POST","/register", function() {
                Formulaire::sign_up($_POST,$_SERVER['REQUEST_METHOD']);
            });
        
            $routes->map("POST","/modifier/information/[i:id]", function($id) {
                User::modifier_information_compte($_POST,$_SERVER['REQUEST_METHOD'],(int)$id['id']);
            });

            $routes->map("POST","/update/password/[i:id]", function($id) {
                User::modifier_mot_de_passe($_POST,$_SERVER['REQUEST_METHOD'],(int)$id['id']);
            });

            // route pour ajouter un jeu , une exploaration, un module
            $routes->map("POST","/administration/add/expoloration",function(){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::ajouter_un_exploration($_POST,$_SERVER['REQUEST_METHOD']);
            });

            $routes->map("POST","/administration/add/quiz",function(){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::ajouter_un_jeu($_POST,$_SERVER['REQUEST_METHOD']);
            });

            $routes->map("PUT","/administration/quiz/[i:id]",function($id){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::modifier_jeu($_POST,$_SERVER['REQUEST_METHOD'],(int)$id['id']);
            });

            $routes->map("DELETE","/administration/quiz/[i:id]",function($id){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::supprimer_jeu((int)$id['id']);
            });

            $routes->map("POST","/administration/add/category",function(){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::ajouter_une_categorie($_POST);
            });

            $routes->map("DELETE","/administration/category/[i:id]",function($id){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::supprimer_une_categorie((int)$id['id']);
            });

            $routes->map("DELETE","/clean/user/[i:id]",function($id){
                echo "<pre>";
                 var_dump($id);
                echo "</pre>";
             
            });

            //chemin vers la dashboard d ou /administration route
            $routes->map("GET","/administration/dashboard", function() {
                Page::dashboard("dashboard");
            });

            $routes->map("GET","/administration/users",function() {
               // Page::getPage("utilisateurs");
               Page::dashboard("utilisateurs");
            });
        
            $routes->map("GET","/administration/contenus",function() {
                Page::dashboard("contenu");
            });

            $routes->map("GET","/administration/plaintes",function() {
                Page::dashboard("feedbacks");
            });

            $routes->map("GET","/administration/ligues",function() {
                Page::dashboard("ligues");
            });
            
            $routes->map("GET","/administration/parametres",function() {
                Page::dashboard("parametres");
            });
            
            // Routes pour le bannissement des utilisateurs
            $routes->map("POST", "/administration/ban/user/[i:id]", function($id) {
                Admin::banir_utilisateur((int)$id['id']);
            });

            //Routes pour le chat
            $routes->map("GET", "/chat", function() {
                $page = new \App\Controllers\Page\Page();
                $page->getPage("chat");
            });

            $routes->map("POST", "/chat/send", function() {
                $user = new \App\Controllers\User\User();
                $data = json_decode(file_get_contents('php://input'), true);
                $success = $user->envoyer_message($data['message']);
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
            });

            $routes->map("GET", "/chat/messages", function() {
                $messages = User::recuperer_messages();
               // var_dump($messages);
                 header("Access-Control-Allow-Headers: Content-Type, Authorization");
                 header('Content-Type: application/json');
                 echo json_encode($messages);
            });

            $routes->map("POST","/user/explorations", function() {
                \App\Middlewares\Security\Security::require_role('joueur');
                \App\Controllers\User\User::ajouter_une_exploration($_POST, $_SERVER['REQUEST_METHOD']);
            });

            $routes->map("PUT","/user/explorations/[i:id]", function($id) {
                \App\Middlewares\Security\Security::require_role('joueur');
                \App\Controllers\User\User::modifier_exploration($_POST, $_SERVER['REQUEST_METHOD'], (int)$id['id']);
            });

            $routes->map("DELETE","/user/explorations/[i:id]", function($id) {
                \App\Middlewares\Security\Security::require_role('joueur');
                \App\Controllers\User\User::supprimer_exploration((int)$id['id']);
            });

            $routes->map("POST","/administration/add/module",function(){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::ajouter_un_module($_POST,$_SERVER['REQUEST_METHOD']);
            });

            $routes->map("PUT","/administration/module/[i:id]",function($id){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::modifier_module($_POST,$_SERVER['REQUEST_METHOD'],(int)$id['id']);
            });

            $routes->map("DELETE","/administration/module/[i:id]",function($id){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::supprimer_module((int)$id['id']);
            });

            $routes->map("PUT","/administration/exploration/[i:id]",function($id){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::modifier_exploration($_POST,$_SERVER['REQUEST_METHOD'],(int)$id['id']);
            });

            $routes->map("DELETE","/administration/exploration/[i:id]",function($id){
                \App\Middlewares\Security\Security::require_role('administrateur');
                Admin::supprimer_exploration((int)$id['id']);
            });

            $match = $routes->match();
            
            if($match)
            {
                if(is_callable($match['target']))
                {
                  call_user_func($match['target'],$match['params']);
                }

                else
                {
                    list($controllerName,$method) = explode("#",$match['target']);
                    $controller = new $controllerName();
                    call_user_func_array([$controller,$method],$match['params']);
                }       
            }

?>