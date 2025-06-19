<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligues - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="dark-theme">
    <div class="app-container">
        <!-- Sidebar pour Desktop -->
        
        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header mobile -->
            <header class="mobile-header">
                <img src="img/logo.png" alt="Logo" class="logo">
                <h1>Ligues</h1>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Contenu de la page ligues -->
            <div class="leagues-content">
                <section class="current-league">
                    <div class="league-badge bronze">
                        <i class="fas fa-medal"></i>
                    </div>
                    <div class="league-info">
                        <h2>Ligue Bronze</h2>
                        <p>Votre rang actuel: #<?= $_SESSION['user'][0]['rang'] ?? 100 ?></p>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: 0%"></div>
                            </div>
                            <div class="progress-labels">
                                <span>0 / 100 points</span>
                                <span>Prochain rang: Ligue Diamant</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="leagues-overview">
                    <h2>Toutes les Ligues</h2>
                    
                    <div class="leagues-grid">
                        <div class="league-card bronze active">
                            <div class="league-icon">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Bronze</h3>
                            <p>0 - 100 points</p>
                            <div class="current-badge">Actuel</div>
                        </div>
                        <div class="league-card silver">
                            <div class="league-icon">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Argent</h3>
                            <p>101 - 250 points</p>
                        </div>
                        <div class="league-card gold">
                            <div class="league-icon">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Or</h3>
                            <p>251 - 500 points</p>
                        </div>
                        <div class="league-card platinum">
                            <div class="league-icon">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h3>Platine</h3>
                            <p>501 - 750 points</p>
                        </div>
                        <div class="league-card emerald ">
                            <div class="league-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                            <h3>Émeraude</h3>
                            <p>751 - 1000 points</p>
                            <!-- <div class="current-badge">Actuel</div> -->
                        </div>
                        <div class="league-card diamond">
                            <div class="league-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                            <h3>Diamant</h3>
                            <p>1001 - 1500 points</p>
                        </div>
                        <div class="league-card titan">
                            <div class="league-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h3>Titan</h3>
                            <p>1501 - 2000 points</p>
                        </div>
                        <div class="league-card legend">
                            <div class="league-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h3>Légende</h3>
                            <p>2001 - 3000 points</p>
                        </div>
                        <div class="league-card stellar">
                            <div class="league-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Stellar</h3>
                            <p>3001+ points</p>
                        </div>
                    </div>
                </section>

                <section class="league-leaderboard">
                    <h2>Classement Ligue Émeraude</h2>
                    
                    <div class="leaderboard-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Rang</th>
                                    <th>Joueur</th>
                                    <th>Points</th>
                                    <th>Quiz</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="player-info">
                                            <img src="img/avatar1.png" alt="Avatar" class="small-avatar">
                                            <span>Sophie Martin</span>
                                        </div>
                                    </td>
                                    <td>980</td>
                                    <td>45</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="player-info">
                                            <img src="img/avatar2.png" alt="Avatar" class="small-avatar">
                                            <span>Lucas Bernard</span>
                                        </div>
                                    </td>
                                    <td>925</td>
                                    <td>42</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="player-info">
                                            <img src="img/avatar3.png" alt="Avatar" class="small-avatar">
                                            <span>Emma Petit</span>
                                        </div>
                                    </td>
                                    <td>890</td>
                                    <td>40</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <div class="player-info">
                                            <img src="img/avatar4.png" alt="Avatar" class="small-avatar">
                                            <span>Hugo Leroy</span>
                                        </div>
                                    </td>
                                    <td>870</td>
                                    <td>38</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <div class="player-info">
                                            <img src="img/avatar5.png" alt="Avatar" class="small-avatar">
                                            <span>Chloé Dubois</span>
                                        </div>
                                    </td>
                                    <td>845</td>
                                    <td>37</td>
                                </tr>
                                <tr class="current-user">
                                    <td>42</td>
                                    <td>
                                        <div class="player-info">
                                            <img src="img/avatar.png" alt="Avatar" class="small-avatar">
                                            <span>Thomas Dupont</span>
                                        </div>
                                    </td>
                                    <td>750</td>
                                    <td>30</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="league-benefits">
                    <h2>Avantages de la Ligue Émeraude</h2>
                    
                    <div class="benefits-list">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-unlock"></i>
                            </div>
                            <div class="benefit-info">
                                <h3>Quiz exclusifs</h3>
                                <p>Accès à des quiz spéciaux réservés aux membres Émeraude et plus</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="benefit-info">
                                <h3>Points bonus</h3>
                                <p>+20% de points pour chaque quiz complété</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="benefit-info">
                                <h3>Trophées exclusifs</h3>
                                <p>Débloquez des trophées spéciaux réservés à votre ligue</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <div class="benefit-info">
                                <h3>Thèmes personnalisés</h3>
                                <p>Accès à des thèmes d'interface exclusifs</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <!-- Navigation mobile -->
        <nav class="mobile-nav">
            <ul>
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="jeux.html">
                        <i class="fas fa-gamepad"></i>
                        <span>Jeux</span>
                    </a>
                </li>
                <li>
                    <a href="profile.html">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </li>
                <li class="active">
                    <a href="ligue.html">
                        <i class="fas fa-trophy"></i>
                        <span>Ligues</span>
                    </a>
                </li>
                <li>
                    <a href="parametres.html">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
