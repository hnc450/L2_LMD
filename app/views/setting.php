<?php 
  if(!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar pour Desktop -->
        <?php
           require __DIR__ . '/sidebar.php';
        ?>
        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header mobile -->
            <header class="mobile-header">
                <img src="/assets/logo.jpeg" alt="Logo" class="logo">
                <h1>Paramètres</h1>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Contenu de la page paramètres -->
            <div class="settings-content">
                <section class="settings-section">
                    <h2>Informations personnelles</h2>
                    
                    <form class="settings-form" action="/modifier/information/<?= $_SESSION['user']['id_user'] ?? ''?>" method="POST">
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" id="pseudo" value="<?= $_SESSION['user']['pseudo'] ?? ''?>" name="pseudo">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" value="<?= $_SESSION['user']['mails'] ?? '' ?>" name="email">
                        </div>
                   
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" value="<?= $_SESSION['user']['prenoms'] ?? '' ?>" name="prenom">
                        </div>
                        <button type="submit" class="btn-primary">Enregistrer les modifications</button>
                    </form>
                </section>

                <section class="settings-section">
                    <h2>Sécurité</h2>
                    
                    <form class="settings-form" action="/update/password/<?= $_SESSION['user']['id_user'] ?? ''?>" method="POST">
                        <div class="form-group">
                            <label for="current-password">Mot de passe actuel</label>
                            <input type="password" id="current-password" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password">Nouveau mot de passe</label>
                            <input type="password" id="new-password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmer le mot de passe</label>
                            <input type="password" id="confirm-password" name="confirm_password">
                        </div>
                        <button type="submit" class="btn-primary">Changer le mot de passe</button>
                    </form>
                </section>

                <section class="settings-section">
                    <h2>Apparence</h2>
                    
                    <div class="theme-selector">
                        <div class="theme-option active" data-theme="dark">
                            <div class="theme-preview dark">
                                <div class="preview-header"></div>
                                <div class="preview-content"></div>
                            </div>
                            <p>Thème sombre</p>
                        </div>
                        <div class="theme-option" data-theme="light">
                            <div class="theme-preview light">
                                <div class="preview-header"></div>
                                <div class="preview-content"></div>
                            </div>
                            <p>Thème clair</p>
                        </div>
                    </div>
                </section>

                <section class="settings-section">
                    <h2>Notifications</h2>
                    
                    <div class="settings-options">
                        <div class="toggle-option">
                            <div>
                                <h3>Notifications par email</h3>
                                <p>Recevoir des emails sur les nouveaux quiz et événements</p>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-option">
                            <div>
                                <h3>Notifications push</h3>
                                <p>Recevoir des notifications sur votre appareil</p>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </section>

                <section class="settings-section">
                    <h2>Session</h2>
                    <button class="btn-danger logout-btn">
                        <i class="fas fa-sign-out-alt"></i> <a href="/">Se déconnecter</a>
                    </button>
                </section>
            </div>
        </main>

        <!-- Navigation mobile -->
        <nav class="mobile-nav">
            <ul>
                <li>
                    <a href="/user/home">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="/user/jeux">
                        <i class="fas fa-gamepad"></i>
                        <span>Jeux</span>
                    </a>
                </li>
                <li>
                    <a href="/user/profile">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </li>
                <li>
                    <a href="/user/ligue">
                        <i class="fas fa-trophy"></i>
                        <span>Ligues</span>
                    </a>
                </li>
                <li class="active">
                    <a href="/user/parametres">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <script src="/js/script.js" defer></script>
</body>
</html>
