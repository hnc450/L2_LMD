<?php 
     $settings = \App\Controllers\Admin\Admin::get_admin_settings();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles spécifiques pour la page paramètres */
        .settings-section {
            margin-bottom: var(--spacing-xl);
        }

        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-lg);
        }

        .setting-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
            border: 1px solid var(--border-color);
        }

        .setting-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .setting-card h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: var(--spacing-md);
            color: var(--text-color);
        }

        .setting-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-md);
        }

        .setting-option label {
            font-size: 1rem;
            color: var(--text-color);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-switch label {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--border-color);
            border-radius: 30px;
            cursor: pointer;
            transition: background-color var(--transition-normal);
        }

        .toggle-switch label::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background-color: white;
            border-radius: 50%;
            transition: transform var(--transition-normal);
        }

        .toggle-switch input:checked + label {
            background-color: var(--primary-color);
        }

        .toggle-switch input:checked + label::after {
            transform: translateX(30px);
        }

        .save-settings {
            display: flex;
            justify-content: center;
            margin-top: var(--spacing-xl);
        }

        .action-btn.primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: var(--border-radius-lg);
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar will be loaded here -->
        <div class="sidebar-container"></div>

        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header pour toutes les tailles d'écran -->
            <header class="main-header">
                <div class="header-left">
                    <img src="" alt="Logo" class="logo">
                    <h1>Paramètres du Jeu</h1>
                </div>
                <div class="header-right">
                    <!-- Theme Toggle will be loaded here -->
                    <div class="theme-toggle-container"></div>
                    <div class="user-info-header">
                        <img src="<?= $_SESSION['user']['avatar']?>" alt="Avatar" class="avatar">
                        <div>
                            <p class="username"><?= $_SESSION['user']['prenoms'] ?></p>
                            <p class="rank"><?= $_SESSION['user']['role'] ?></p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Page Header -->
                <div class="page-header">
                  <?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
                    <div class="save-settings" >
                        <button  class="action-btn primary" id="pop-up" >
                            <?= $_SESSION['message'] ?>
                        </button>
                    </div>
                  <?php endif?>
                   
                    <h2><i class="fas fa-cog"></i> Paramètres du Jeu</h2>
                    <p>Gérez les règles, fonctionnalités et notifications du jeu</p>
                </div>

                <!-- Paramètres Section -->
                <div class="settings-section">
                    <h3><i class="fas fa-sliders-h"></i> Paramètres Généraux</h3>
                    <div class="settings-grid">
                        <div class="setting-card">
                            <h4>Règles du Jeu</h4>
                            <div class="setting-option">
                                <label>Activer le mode multijoueur</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="multiplayer" checked>
                                    <label for="multiplayer"></label>
                                </div>
                            </div>
                            <div class="setting-option">
                                <label>Activer les récompenses</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="rewards" checked>
                                    <label for="rewards"></label>
                                </div>
                            </div>
                            <div class="setting-option">
                                <label>Activer les classements</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="leaderboard" checked>
                                    <label for="leaderboard"></label>
                                </div>
                            </div>
                        </div>
                        <div class="setting-card">
                            <h4>Notifications</h4>
                            <div class="setting-option">
                                <label>Notifications par email</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="email-notifications" checked>
                                    <label for="email-notifications"></label>
                                </div>
                            </div>
                            <div class="setting-option">
                                <label>Notifications push</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="push-notifications" checked>
                                    <label for="push-notifications"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sauvegarder Button -->
                <div class="save-settings">
                    <button class="action-btn primary">
                        <i class="fas fa-save"></i>
                        Sauvegarder les Paramètres
                    </button>
                </div>
            </div>
        </main>
        <!-- ajout du formulaire pour les paramètres -->
        <form action="/administration/add/settings" method="post">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?= $_SESSION['user']['id_user']?>">
            <input type="text" name="setting_name" placeholder="Nom du paramètre">
            <input type="text" name="setting_value" placeholder="Valeur du paramètre 1 ou 0 (active ou inactive)">
            <button type="submit" class="action-btn primary">Enregistrer</button>
        </form>

        <?=count($settings) ?>
        <!-- Navigation mobile admin -->
 
    </div>
    <?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])):?>
        <script>
                setTimeout(()=>{
                    document.getElementById('pop-up').style.display = 'none'
                },6000)
        </script>
        <?php $_SESSION['message'] = '';?>
    <?php endif ?>
    <script src="/js/theme.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/script.js" defer></script>
</body>
</html> 