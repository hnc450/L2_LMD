<h1> l affichage du module</h1>
<pre>
    
<?php

$json = json_decode($module[0]['content'],true,512,JSON_THROW_ON_ERROR);
 var_dump($module[0]['content'])

?>
</pre>
<?php 
function afficherJSON($data, $indent = 0) {
    foreach ($data as $cle => $valeur) {
        // Indentation visuelle
        $prefixe = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $indent);
        
        if (is_array($valeur)) {
            echo $prefixe . "<strong>" . ucfirst($cle) . ":</strong><br>";
            // Appel récursif
            afficherJSON($valeur, $indent + 1);
        } else {
            echo $prefixe . "<strong>" . ucfirst($cle) . ":</strong> " . $valeur . "<br>";
        }
    }
}
afficherJSON(json_decode($module[0]['content']))

?>

