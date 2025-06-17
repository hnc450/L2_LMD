<?php 
            use App\Models\Component\Component;
            use App\Controllers\Page\Page;
            use App\Controllers\Formulaire\Formulaire;
            use App\Controllers\User\User;
            use App\Controllers\Action\Action;
            use App\Controllers\Admin\Admin;

            $routes->map("GET","/", function() {
                //echo  Component::P("url avec ltrim: ",null,"color: white; font-size: 20px;text-align: center;");
                Page::getPage("welcome");
            });
            $routes->map("GET","/chat", function() {
                Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });
            $routes->map("GET","/home", function() {
               
                Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });

            $routes->map("GET","/jeux", function() {
                Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });
            $routes->map("GET","/modules",function(){
                Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });

            $routes->map("GET","/profile", function() {
                 Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });

            $routes->map("GET","/ligue", function() {
                  Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });

            $routes->map("GET","/parametres", function() {
                Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });
            $routes->map("GET","/routes", function() {
             echo "salut routes pour le test";
            });
            $routes->map("GET","/login",function(){
                 Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
                // echo Component::P(explode('?',$_SERVER['REQUEST_URI'])[0],null,"color: white; font-size: 20px;text-align: center;");
            });
            
            $routes->map("GET","/explorations", function() {
                Page::getPage(ltrim($_SERVER['REQUEST_URI'],"/"));
            });

            $routes->map("GET","/deconnexion",function(){
                User::se_deconnecter();
            });
            // user , users une routes pour l administration encore
            $routes->map("GET","/user/[i:id]",function($id){
              Page::getPageWithId("user",$id['id']);
            });

            $routes->map("GET","/users",function(){
               Page::getPage("utilisateurs");
            });

            // Message route
            $routes->map("GET","/error/[a:message]",function($message){
               // echo $message['message'];
                //echo  "<br/>";
               echo str_replace("0"," ",$message['message']);
            });

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
            $routes->map("POST","/add/expoloration",function(){
                var_dump($_POST);
            });
            $routes->map("POST","/add/jeu",function(){
               echo "<pre>";
               var_dump($_POST);
               echo "</pre>";
               Admin::ajouter_un_jeu($_POST,$_SERVER['REQUEST_METHOD']);
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
                Page::getPage("utilisateurs");
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