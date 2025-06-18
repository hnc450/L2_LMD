<?php 
  if(isset($_SESSION['user'])){
    \App\Middlewares\Security\Security::verify_role($_SESSION['user'][0]['role']);
    exit();
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="dark-theme auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="img/logo.png" alt="Logo" class="logo">
                <h1>Le Monde Dans Ma Poche</h1>
            </div>

            <div class="auth-tabs">
                <button class="auth-tab active" data-tab="login">Connexion</button>
                <button class="auth-tab" data-tab="register">Inscription</button>
            </div>

            <div class="auth-content">
                <!-- Formulaire de connexion -->
                 <?php
                     $tokken = unserialize($_COOKIE['Tokken'] ?? '');
                 ?>
                <form id="loginForm" class="auth-form active" action="/sign" method="POST">
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="loginEmail" placeholder="Votre email" required name="email" value="<?= $tokken['email'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="loginPassword" placeholder="Votre mot de passe" required name="password" value="<?= $tokken['password'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" id="rememberMe" value="1" name="remember" <?= isset($_COOKIE['Tokken']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                            Se souvenir de moi
                        </label>
                        <a href="#" class="forgot-password">Mot de passe oublié?</a>
                    </div>
                    <button type="submit" class="btn-auth">Se connecter</button>
                </form>

                <!-- Formulaire d'inscription -->
                <form id="registerForm" class="auth-form" action="/register" method="POST">
                    <div class="form-group">
                        <label for="registerName">Nom complet</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="registerName" placeholder="Votre prenom" required name="prenom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registerPseudo">Pseudo</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user-tag"></i>
                            <input type="text" id="registerPseudo" placeholder="Votre pseudo" required name="pseudo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="registerEmail" placeholder="Votre email" required name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="registerPassword" placeholder="Votre mot de passe" required name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registerConfirmPassword">Confirmer le mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="registerConfirmPassword" placeholder="Confirmez votre mot de passe" required name="confirmPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sexe: </label>
                       <div class="age-options">
                          <label class="age-option">
                                  <input type="radio" name="sexe" value="Feminin">
                                  <span>Feminin</span>
                          </label>
  
                          <label class="age-option">
                                  <input type="radio" name="sexe" value="Masculin">
                                  <span>Masculin</span>
                          </label>
                       </div>
                    </div>
                    <div class="form-group">
                        <label>Tranche d'âge</label>
                        <div class="age-options">
                            <label class="age-option">
                                <input type="radio" name="age" value="6-8">
                                <span>6-8 ans</span>
                            </label>
                            <label class="age-option">
                                <input type="radio" name="age" value="9-11">
                                <span>9-11 ans</span>
                            </label>
                            <label class="age-option">
                                <input type="radio" name="age" value="12-14">
                                <span>12-14 ans</span>
                            </label>
                            <label class="age-option">
                                <input type="radio" name="age" value="15+">
                                <span>15+ ans</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" id="termsAccept" required>
                            <span class="checkmark"></span>
                            J'accepte les <a href="#">conditions d'utilisation</a>
                        </label>
                    </div>
                    <button type="submit" class="btn-auth">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/auth.js"></script>
</body>
</html>
