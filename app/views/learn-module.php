<?php  
$content = json_decode($module[0]['content'],true);
$count = 0;
?>
<?php foreach($module as $module):?>
        <?php  foreach($content as $contenu): ?>
         
          <div class="module" data-id="<?= $module['id']?>"> 
               <div class="modules-container" id="<?= $contenu['id'] ?>">
                   
                    <p><?= $content[$count]['title'] ?></p>
                    <p><?= $content[$count]['texte'] ?></p>
                
                    <label for="#"><?= $content[$count]['question'] ?></label>
                    <input type="text" name="reponses">
                    <p> <?= $content[$count]['reponse'] ?></p>
              
               </div>
          </div>
          <?php $count++; ?>
        <?php endforeach ?>

<?php endforeach ?>
