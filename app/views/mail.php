<?php
    $id = \App\Models\Database\Database::executeQuery('SELECT id_user FROM users WHERE mails=:mail',[':mail'=> $_GET['m']],2)[0]['id_user'];
?>
<section class="settings-section">
    <h2>Changer le mot de passe</h2>
    <form id="password-update-form" class="settings-form">
        <div class="form-group">
            <label for="new_mdp">Nouveau mot de passe</label>
            <input type="password" id="mdp" name="mdp" required>
        </div>
        <div class="form-group">
            <label for="confirm">Confirmer le mot de passe</label>
            <input type="password" id="confirm" name="confirm" required>
        </div>
        <button type="submit" class="btn-primary">Mettre à jour</button>
    </form>
    <div id="password-update-message"></div>
</section>
<script>
document.getElementById('password-update-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const mdp = document.getElementById('mdp').value;
    const confirm = document.getElementById('confirm').value;
    const response = await fetch('http://192.168.1.72:8000/reset/password/<?php echo $id; ?>', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 'mdp':mdp, 'confirm':confirm })
    });
    const result = await response.text();
    document.getElementById('password-update-message').innerText = result;
});
</script>
