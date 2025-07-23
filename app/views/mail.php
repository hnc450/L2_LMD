<?php
    $id = \App\Models\Database\Database::executeQuery('SELECT id_user FROM users WHERE mails=:mail',[':mail'=> $_GET['m']],2)[0]['id_user'];
?>

<style>
.password-reset-container {
    max-width: 500px;
    margin: 2rem auto;
    padding: 2rem;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e1e5e9;
}

.password-reset-header {
    text-align: center;
    margin-bottom: 2rem;
}

.password-reset-header h2 {
    color: #2c3e50;
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0;
    margin-bottom: 0.5rem;
}

.password-reset-subtitle {
    color: #6c757d;
    font-size: 0.95rem;
    margin: 0;
}

.settings-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    position: relative;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #374151;
    font-weight: 500;
    font-size: 0.95rem;
}

.form-group input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: #fafafa;
    box-sizing: border-box;
}

.form-group input:focus {
    outline: none;
    border-color: #3b82f6;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-group input:valid {
    border-color: #10b981;
}

.btn-primary {
    width: 100%;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-primary:active {
    transform: translateY(0);
}

#password-update-message {
    margin-top: 1rem;
    padding: 0.75rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    text-align: center;
    min-height: 20px;
}

.message-success {
    background-color: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.message-error {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.password-strength {
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #6b7280;
}

.strength-bar {
    width: 100%;
    height: 4px;
    background-color: #e5e7eb;
    border-radius: 2px;
    margin-top: 0.25rem;
    overflow: hidden;
}

.strength-fill {
    height: 100%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-weak { background-color: #ef4444; width: 25%; }
.strength-fair { background-color: #f59e0b; width: 50%; }
.strength-good { background-color: #3b82f6; width: 75%; }
.strength-strong { background-color: #10b981; width: 100%; }

@media (max-width: 768px) {
    .password-reset-container {
        margin: 1rem;
        padding: 1.5rem;
    }
    
    .password-reset-header h2 {
        font-size: 1.5rem;
    }
}
</style>

<div class="password-reset-container">
    <div class="password-reset-header">
        <h2>🔐 Changer le mot de passe</h2>
        <p class="password-reset-subtitle">Créez un nouveau mot de passe sécurisé pour votre compte</p>
    </div>
    
    <form id="password-update-form" class="settings-form">
        <div class="form-group">
            <label for="mdp">Nouveau mot de passe</label>
            <input type="password" id="mdp" name="mdp" required minlength="8">
            <div class="password-strength">
                <div class="strength-bar">
                    <div class="strength-fill" id="strength-fill"></div>
                </div>
                <span id="strength-text">Entrez un mot de passe</span>
            </div>
        </div>
        
        <div class="form-group">
            <label for="confirm">Confirmer le mot de passe</label>
            <input type="password" id="confirm" name="confirm" required>
        </div>
        
        <button type="submit" class="btn-primary">
            Mettre à jour le mot de passe
        </button>
    </form>
    
    <div id="password-update-message"></div>
</div>

<script>
// Fonction pour évaluer la force du mot de passe
function checkPasswordStrength(password) {
    let strength = 0;
    const strengthFill = document.getElementById('strength-fill');
    const strengthText = document.getElementById('strength-text');
    
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    strengthFill.className = 'strength-fill';
    
    switch(strength) {
        case 0:
        case 1:
            strengthFill.classList.add('strength-weak');
            strengthText.textContent = 'Mot de passe faible';
            break;
        case 2:
        case 3:
            strengthFill.classList.add('strength-fair');
            strengthText.textContent = 'Mot de passe moyen';
            break;
        case 4:
            strengthFill.classList.add('strength-good');
            strengthText.textContent = 'Mot de passe bon';
            break;
        case 5:
            strengthFill.classList.add('strength-strong');
            strengthText.textContent = 'Mot de passe fort';
            break;
    }
}

// Vérification en temps réel du mot de passe
document.getElementById('mdp').addEventListener('input', function(e) {
    checkPasswordStrength(e.target.value);
});

// Soumission du formulaire
document.getElementById('password-update-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const mdp = document.getElementById('mdp').value;
    const confirm = document.getElementById('confirm').value;
    const messageDiv = document.getElementById('password-update-message');
    const submitBtn = e.target.querySelector('button[type="submit"]');
    
    // Validation côté client
    if (mdp !== confirm) {
        messageDiv.className = 'message-error';
        messageDiv.textContent = 'Les mots de passe ne correspondent pas';
        return;
    }
    
    if (mdp.length < 8) {
        messageDiv.className = 'message-error';
        messageDiv.textContent = 'Le mot de passe doit contenir au moins 8 caractères';
        return;
    }
    
    // Désactiver le bouton pendant la requête
    submitBtn.disabled = true;
    submitBtn.textContent = 'Mise à jour en cours...';
    
    try {
        const response = await fetch('http://localhost:8000/reset/password/<?php echo $id; ?>', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 'mdp': mdp, 'confirm': confirm })
        });
        
        const result = await response.text();
        
        if (response.ok) {
            messageDiv.className = 'message-success';
            messageDiv.textContent = result || 'Mot de passe mis à jour avec succès !';
            // Réinitialiser le formulaire
            document.getElementById('password-update-form').reset();
            document.getElementById('strength-fill').className = 'strength-fill';
            document.getElementById('strength-text').textContent = 'Entrez un mot de passe';
        } else {
            messageDiv.className = 'message-error';
            messageDiv.textContent = result || 'Une erreur est survenue';
        }
    } catch (error) {
        messageDiv.className = 'message-error';
        messageDiv.textContent = 'Erreur de connexion au serveur';
    } finally {
        // Réactiver le bouton
        submitBtn.disabled = false;
        submitBtn.textContent = 'Mettre à jour le mot de passe';
    }
});
</script>


<!-- 
<script>
document.getElementById('password-update-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const mdp = document.getElementById('mdp').value;
    const confirm = document.getElementById('confirm').value;
    const response = await fetch('http://localhost:8000/reset/password/<?php echo $id; ?>', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 'mdp':mdp, 'confirm':confirm })
    });
    const result = await response.text();
    document.getElementById('password-update-message').innerText = result;
});
</script> -->