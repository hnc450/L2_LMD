<?php 
     $settings = \App\Controllers\Admin\Admin::get_admin_settings();
     $compteur = 0;
     $limit = 4;
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

.add-setting-form {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(44, 62, 80, 0.10);
    padding: 2rem 1.5rem 1.5rem 1.5rem;
    max-width: 420px;
    margin: 2.5rem auto 1.5rem auto;
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
    animation: fadeIn 0.7s cubic-bezier(.4,0,.2,1);
}

.add-setting-form h3 {
    text-align: center;
    color: #2980b9;
    font-weight: 700;
    margin-bottom: 0.7rem;
    font-size: 1.25rem;
    letter-spacing: 0.5px;
}

.add-setting-form input[type="text"] {
    padding: 0.85rem 1rem;
    border-radius: 8px;
    border: 1.5px solid #b2bec3;
    font-size: 1.05rem;
    background: #f8fbfd;
    transition: border 0.2s, box-shadow 0.2s;
}

.add-setting-form input[type="text"]:focus {
    border: 2px solid #2980b9;
    box-shadow: 0 0 0 2px #6dd5fa55;
    outline: none;
    background: #fff;
}

.add-setting-form button[type="submit"] {
    padding: 0.85rem 1.1rem;
    background: linear-gradient(90deg, #2980b9 60%, #6dd5fa 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1.08rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    box-shadow: 0 2px 8px rgba(41,128,185,0.08);
    letter-spacing: 0.5px;
}

.add-setting-form button[type="submit"]:hover {
    background: linear-gradient(90deg, #2573a6 60%, #51b6e7 100%);
    transform: translateY(-2px) scale(1.02);
}
.add-setting-form {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 32px rgba(44, 62, 80, 0.13);
    padding: 2.2rem 2rem 1.7rem 2rem;
    max-width: 430px;
    margin: 2.5rem auto 2rem auto;
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
    animation: fadeIn 0.7s cubic-bezier(.4,0,.2,1);
}

.add-setting-form h3 {
    text-align: center;
    color: #2980b9;
    font-weight: 800;
    margin-bottom: 0.7rem;
    font-size: 1.35rem;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.input-group label {
    font-size: 1rem;
    color: #2980b9;
    font-weight: 600;
    margin-bottom: 0.1rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.add-setting-form input[type="text"] {
    padding: 0.85rem 1.1rem;
    border-radius: 9px;
    border: 1.5px solid #b2bec3;
    font-size: 1.07rem;
    background: #f8fbfd;
    transition: border 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(41,128,185,0.07);
}

.add-setting-form input[type="text"]:focus {
    border: 2px solid #2980b9;
    box-shadow: 0 0 0 2px #6dd5fa55;
    outline: none;
    background: #fff;
}

.add-setting-form button[type="submit"] {
    padding: 0.95rem 1.1rem;
    background: linear-gradient(90deg, #2980b9 60%, #6dd5fa 100%);
    color: #fff;
    border: none;
    border-radius: 9px;
    font-size: 1.13rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    box-shadow: 0 2px 8px rgba(41,128,185,0.09);
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.add-setting-form button[type="submit"]:hover {
    background: linear-gradient(90deg, #2573a6 60%, #51b6e7 100%);
    transform: translateY(-2px) scale(1.02);
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
                           <?php 
                                while($compteur < count($settings) -1 && $compteur < $limit){
                                    echo '
                                       <div class="setting-option">
                                           <label> '.$settings[$compteur]['setting_name'].'</label>
                                           <div class="toggle-switch">
                                               <input type="checkbox"  data-id="'.$settings[$compteur]['id'].'"  id="'.$settings[$compteur]['id'].'" '.($settings[$compteur]['setting_value'] == 1 ? 'checked' : '').'>
                                               <label for="'.$settings[$compteur]['id'].'"></label>
                                           </div>
                                       </div>';
                                    $compteur+=1;
                                }
                              
                            ?>
                        </div>
                        <div class="setting-card">
                            <?php
                                 while($compteur < count($settings)){
                                    echo '
                                      <div class="setting-option">
                                          <label> '.$settings[$compteur]['setting_name'].'</label>
                                          <div class="toggle-switch">
                                              <input type="checkbox" data-id="'.$settings[$compteur]['id'].'" id="'.$settings[$compteur]['id'].'" '.($settings[$compteur]['setting_value'] == 1 ? 'checked' : '').'>
                                              <label for="'.$settings[$compteur]['id'].'"></label>
                                          </div>
                                      </div>';
                                    $compteur+=1;
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Sauvegarder Button -->
                <!-- <div class="save-settings">
                    <button class="action-btn primary">
                        <i class="fas fa-save"></i>
                        Sauvegarder les Paramètres
                    </button>
                </div> -->
            </div>
        </main>
        <!-- ajout du formulaire pour les paramètres -->

        <form action="/administration/add/settings" method="post" class="add-setting-form">
            <h3><i class="fas fa-plus-circle" style="color:#2980b9;"></i> Ajouter un paramètre</h3>
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?= $_SESSION['user']['id_user']?>">
            <div class="input-group">
                <label for="setting_name"><i class="fas fa-tag"></i> Nom du paramètre</label>
                <input type="text" name="setting_name" id="setting_name" placeholder="Ex: leaderboard, rewards..." required>
            </div>
            <div class="input-group">
                <label for="setting_value"><i class="fas fa-toggle-on"></i> Valeur (1 = active, 0 = inactive)</label>
                <input type="text" name="setting_value" id="setting_value" placeholder="1 ou 0" required pattern="[01]">
            </div>
            <button type="submit" class="action-btn primary"><i class="fas fa-check"></i> Enregistrer</button>
        </form>
     
        
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
 
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/script.js" defer></script>
    <script>
        document.querySelectorAll('input[type="checkbox"][data-id]').forEach(checkbox => {
  checkbox.addEventListener('change', function() {
    const id = this.getAttribute('data-id');
    const value = this.checked ? 1 : 0;

    fetch('/settings/update', {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        id: id,
        value: value
      })
    })
    .then(res => res.json())
    .then(data => {
      // Optionnel : afficher un message de succès ou d’erreur
      alert(data.message);
    });
  });
});
    </script>
</body>
</html> 