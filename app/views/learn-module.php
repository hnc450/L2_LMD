<?php  
// Assure-toi que la session est démarrée

$content = json_decode($module[0]['content'], true);
$count = 0;
$max_points = count($content);
$module_id = $module[0]['id']; 

// Initialiser les points si non définis
if (!isset($_SESSION['points_module'])) {
    $_SESSION['points_module'] = 0;
}
if (!isset($_SESSION['current_module'])) {
    $_SESSION['current_module'] = $module_id;
} elseif ($_SESSION['current_module'] !== $module_id) {
    $_SESSION['points'] = 0;
    $_SESSION['current_module'] = $module_id;
}


$points = $_SESSION['points_module'];

// Réinitialiser si dépassement
if ($points >= $max_points) {
    $_SESSION['points_module'] = $max_points; // On bloque à max
    $points = $max_points;
}

// Traitement du formulaire
if (isset($_POST['reponse']) && isset($_POST['correct'])) {
    $reponse = strip_tags(htmlspecialchars($_POST['reponse']));
    $correct = strip_tags(htmlspecialchars($_POST['correct']));

    if ($points < $max_points) {
        if ($reponse === $correct) {
            echo "<p>✅ Bonne réponse !</p>";
            $_SESSION['points_module'] += 1;
            $points = $_SESSION['points_module'];
        } else {
            echo "<p>❌ Mauvaise réponse. La bonne réponse était : <strong>$correct</strong></p>";
        }
    } else {
        echo "<p>✅ Module terminé ! Score maximum atteint.</p>";
    }
}
?>

<a href="/user/modules"><button>Quittez le module</button></a>
<p>Points: <?= $points ?> / <?= $max_points ?></p>

<?php foreach ($module as $module): ?>
    <?php foreach ($content as $contenu): ?>
        <div class="module" data-id="<?= $module['id'] ?>"> 
            <div class="modules-container" id="<?= $contenu['id'] ?>">
                <p><strong><?= $contenu['title'] ?></strong></p>
                <p><?= $contenu['texte'] ?></p>
                <label><?= $contenu['question'] ?></label>
                <form action="" method="POST">
                    <input type="text" name="reponse" required>
                    <input type="text" name="correct" value="<?= $contenu['reponse'] ?>">
                    <button type="submit">Vérifier</button>
                </form>
            </div>
        </div>
    <?php endforeach ?>
<?php endforeach ?>
