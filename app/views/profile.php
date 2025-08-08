<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Le Monde Dans Ma Poche</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="app-container">
        <!-- Sidebar pour Desktop -->
        <?php
        require (__DIR__) . '/templates/sidebar.php';
        ?>
        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header mobile -->
            <header class="mobile-header">
                <img src="/assets/logo.jpeg" alt="Logo" class="logo">
                <h1>Profil</h1>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Contenu de la page profil -->
            <div class="profile-content">
                <section class="profile-header">
                    <div class="profile-avatar">

                        <!-- Affichage de l'avatar utilisateur (ou avatar par défaut) -->
                        <img src="<?= $_SESSION['user']['avatar'] ? $_SESSION['user']['avatar'] : '/assets/avatar.png' ?>" alt="Avatar" style="width:120px;height:120px;border-radius:50%;object-fit:cover;">
                        <!-- <form action="/user/profile/avatar" method="POST" enctype="multipart/form-data" style="margin-top:10px;">
                            <input type="file" name="image" accept="image/*" required>
                            <button type="submit" class="btn-primary">Changer d'avatar</button>
                        </form> -->
                        <?php // if (isset($uploadError)): ?>
                            <!-- <div style="color:red; font-size:14px; margin-top:5px;"> <?= $uploadError ?> </div> -->
                        <?php //endif; ?>
                        <!-- Bouton de suppression d'avatar -->
                        <!-- <button id="delete-avatar-btn" class="btn-danger" style="margin-top:5px;">Supprimer l'avatar</button> -->
                    </div>
                    <div class="profile-info">
                        <h2><?= $_SESSION['user']['status'] ? "<i class='fa-solid fa-circle' style='color: green;'></i>" : "<i class='fa-solid fa-circle' style='color: red;'></i>" ?> <?= $_SESSION['user']['prenoms'] ?></h2>
                        <!-- <p class="profile-rank"><i class="fas fa-gem"></i> Ligue Bronze</p>
                        <p class="profile-joined"><i class="fas fa-calendar"></i> : ------</p> -->
                    </div>
                </section>

                <section class="profile-stats">
                    <div class="stat-card">
                        <i class="fas fa-star"></i>
                        <div>
                            <h3>Point<?= (isset($_SESSION['points']) && $_SESSION['points'] > 1) ? 's' : '' ?></h3>
                            <p><?= $_SESSION['points'] ?? 0 ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <i class="fas fa-user"></i>
                        <div>
                            <h3>Pseudo</h3>
                            <p><?= $_SESSION['user']['pseudo'] ?></p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3>Addresse mail</h3>
                            <p><?= $_SESSION['user']['mails']?></p>
                        </div>
                    </div>
                </section>

                <!-- <section class="trophies-section">
                    <div class="section-header">
                        <h2>Mes Trophées</h2>
                    </div>

                    <div class="trophies-grid">
                        <div class="trophy-card">
                            <div class="trophy-icon gold">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Expert Géographie</h3>
                            <p>100 quiz de géographie réussis</p>
                        </div>
                        <div class="trophy-card">
                            <div class="trophy-icon silver">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Historien</h3>
                            <p>50 quiz d'histoire réussis</p>
                        </div>
                        <div class="trophy-card">
                            <div class="trophy-icon bronze">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Scientifique</h3>
                            <p>25 quiz de sciences réussis</p>
                        </div>
                        <div class="trophy-card">
                            <div class="trophy-icon gold">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Explorateur</h3>
                            <p>Tous les continents explorés</p>
                        </div>
                        <div class="trophy-card">
                            <div class="trophy-icon silver">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Persévérant</h3>
                            <p>Connecté 30 jours de suite</p>
                        </div>
                        <div class="trophy-card">
                            <div class="trophy-icon bronze">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Rapide</h3>
                            <p>Quiz terminé en moins de 1 minute</p>
                        </div>
                        <div class="trophy-card locked">
                            <div class="trophy-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h3>???</h3>
                            <p>Trophée verrouillé</p>
                        </div>
                        <div class="trophy-card locked">
                            <div class="trophy-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h3>???</h3>
                            <p>Trophée verrouillé</p>
                        </div>
                    </div>
                </section> -->

                <section class="recent-activity">
                    <div class="section-header">
                        <h2>Activité Récente</h2>
                    </div>

                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <div class="activity-info">
                                <h3>Quiz de Géographie - Europe</h3>
                                <p>Score: 9/10 - Il y a 2 heures</p>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="activity-info">
                                <h3>Trophée débloqué: Persévérant</h3>
                                <p>Il y a 1 jour</p>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <div class="activity-info">
                                <h3>Quiz d'Histoire - Moyen Âge</h3>
                                <p>Score: 8/10 - Il y a 2 jours</p>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-level-up-alt"></i>
                            </div>
                            <div class="activity-info">
                                <h3>Promotion en Ligue Émeraude</h3>
                                <p>Il y a 3 jours</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="settings-section">
                    <h2>Compte</h2>
                    <button class="btn-danger delete-account" id="delete-account-btn">
                        <i class="fa-solid fa-trash"></i> Supprimer mon compte
                    </button>
                </section>
            </div>
        </main>
        <?php 
             require __DIR__ . '/templates/mobile.php';
        ?>
    </div>

    <script src="/js/script.js" defer></script>
    <script>
        document.getElementById('delete-avatar-btn').addEventListener('click', function() {
            if (confirm('Voulez-vous vraiment supprimer votre avatar ?')) {
                fetch('/user/delete/avatar', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.alert(data.success);
                            window.location.reload();
                        } else {
                            alert('Erreur lors de la suppression de l\'avatar.');
                        }
                    })
                    .catch(() => alert('Erreur lors de la suppression de l\'avatar.'));
            }
        });

        document.getElementById('delete-account-btn').addEventListener('click', function() {
            if (confirm('Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible.')) {
                fetch(`http://localhost:8000/delete/account/<?php echo $_SESSION['user']['id_user'] ?>`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Votre compte a été supprimé avec succès.');
                            window.location.href = '/login';
                        } else {
                            alert('Erreur lors de la suppression du compte.');
                        }
                    })
                    .catch(() => alert('Erreur lors de la suppression du compte.'));
            }
        });
    </script>
</body>

</html>