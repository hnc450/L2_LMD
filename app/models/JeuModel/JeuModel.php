<?php 
 namespace App\Models\JeuModel;
   class JeuModel
   {
      public static function recuperer_tous_les_jeux()
      {
         $query = "SELECT jeux.*,categories.categorie as categorie FROM
          jeux INNER JOIN categories ON jeux.id_categorie = categories.id_categorie";
         return \App\Models\Database\Database::QueryRequest($query,2);
      }

      public function see_one(int $id)
      {
         return \App\Models\Database\Database::executeQuery('SELECT jeux.*,categories.categorie as categorie FROM jeux INNER JOIN categories 
         ON jeux.id_categorie = categories.id_categorie
         WHERE id_jeu=:id',[':id' => $id],2);

      }

      public static function recuperer_un_jeu($id)
      {
         $query = " SELECT 
           jeux.id_jeu,
           jeux.titre,
           jeux.age,
           jeux.duration,
           jeux.description,
           categories.categorie,
           questions.id_question,
           questions.questions,
           reponses.answer_1 ,
           reponses.answer_2 ,
           reponses.answer_3,
           reponses.correct_answer as correct
           FROM jeux 
           INNER JOIN categories ON jeux.id_categorie = categories.id_categorie
           INNER JOIN questions ON jeux.id_jeu = questions.id_jeu
           INNER JOIN reponses ON questions.id_question = reponses.id_question
           WHERE jeux.id_jeu = :id;

         ";
         return \App\Models\Database\Database::executeQuery($query,[':id' => $id],2);
      }
   }

?>