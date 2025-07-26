<?php 
  namespace App\Controllers;
   class GameController 
   {
   
       public function addPoint(string $question = "",  string $reponse = "")
       {
             $id = $_SESSION['user']['id_user'];
            \App\Models\FactoryModel::Factory('question')->updatePoint();
            $points = \App\Models\Database\Database::executeQuery('SELECT points FROM points WHERE user_id = ?', [$id], 2)[0]['points'];
            return $points;
         
       }
       public function userInGame(int $user_id):void{
         if(!(\App\Controllers\Action\Action::check_existence('points','user_id',$user_id))){
             \App\Controllers\FactoryController::getController('Game')->startGame($user_id);
          }
       }

       public function startGame(int $user_id = 0){
         \App\Models\FactoryModel::Factory('question')->registerUserInGame($user_id);
       }
       public function reset(){}

       public function finishGame(){
            \App\Models\FactoryModel::Factory('question')->finishQuiz();
       }
   }
?>