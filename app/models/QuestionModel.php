<?php 
namespace App\Models;

use App\Models\Database\Database;

  class QuestionModel{

    public static function getReponse($id_question) {
    return \App\Models\Database\Database::executeQuery('SELECT correct FROM questions WHERE id_question = ?', [$id_question], 2)[0]['correct'];
    }

    public function updatePoint(){
      $id = $_SESSION['user']['id_user'];
      Database::executeQuery("UPDATE points SET  points = points + 1 WHERE user_id = ? ", [$id], 1);
    }

    public function registerUserInGame($id_user){
      $_SESSION['user']['points'] = 0;
       Database::executeQuery("INSERT INTO points (user_id,points) VALUES (?,?)", [$id_user,0], 1);
    }

    public function resetPoints(){
      $id = $_SESSION['user']['id_user'];
      $points = $_SESSION['points'];
     
      \App\Models\Database\Database::executeQuery('UPDATE points SET points =:p WHERE user_id = :i',[':p' =>$points,':i' =>$id],4);
    }
    
    public function finishQuiz(){
        $id = $_SESSION['user']['id_user'];
        $_SESSION['points'] =  \App\Models\Database\Database::executeQuery('SELECT points FROM points WHERE user_id = ?',[$id],2)[0]['points'];
    }
  }

?>