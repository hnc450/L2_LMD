<?php 
   namespace App\Controllers;

   class LogController{
     public function oneLog(){}

     public function allLog(){
        return \App\Models\Database\Database::QueryRequest('SELECT * FROM logs ORDER BY id DESC LIMIT 5 ',2);
     }
     public function addLog(int $id,string $logAction,$logDescription,string $icon){
         \App\Models\Database\Database::executeQuery('INSERT INTO logs(user_id,actions,descriptions,icon)
          VALUES(:id,:actions,:descriptions,:icon)',
          [
            ':id' => $id,
            ':actions' =>$logAction,
            ':descriptions' => $logDescription,
            ':icon' => $icon
          ]
          ,1);
     }
   }
?>