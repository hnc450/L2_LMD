<?php 
   namespace App\Models;

   class ModuleModel
   {
        
      private int $id;
      private string $noms;
      private $categorie;
      private $content;
      private $datas;

      public function __construct()
      {
         $this->datas = \App\Models\Database\Database::QueryRequest('SELECT modules.id,modules.titre,modules.levels,modules.slug_img,modules.discribe_mod, categories.categorie 
         FROM modules INNER JOIN categories ON modules.categorie_id = categories.id_categorie',2);
      }

      public function getAllModules()
      {
         return $this->datas;
      }

      public function getOneModule(int $module_id)
      {
         $this->datas = \App\Models\Database\Database::executeQuery('SELECT modules.id,modules.content,modules.levels, categories.categorie 
         FROM modules INNER JOIN categories ON modules.categorie_id = categories.id_categorie WHERE modules.id=:id',
         [
            ':id'=>$module_id
         ],2);
         return $this->datas;
      }

   }
?>