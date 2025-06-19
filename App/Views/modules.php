<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/styles.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="dark-theme">
    <div class="app-container">
        <!-- Header pour toutes les tailles d'écran -->
        <header class="main-header">
            <div class="header-left">
                <img src="img/logo.png" alt="Logo" class="logo">
                <h1>Le Monde Dans Ma Poche</h1>
            </div>
            <div class="header-right">
                <div class="theme-toggle">
                    <input type="checkbox" id="themeSwitch" class="theme-switch">
                    <label for="themeSwitch" class="theme-switch-label">
                        <i class="fas fa-sun"></i>
                        <i class="fas fa-moon"></i>
                        <span class="switch-ball"></span>
                    </label>
                </div>
                <div class="user-info-header">
                    <img src="img/avatar.png" alt="Avatar" class="avatar">
                    <div>
                        <p class="username">John Doe</p>
                        <p class="rank">Ligue Émeraude</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="main-content">
            <div class="page-header">
                <h2><i class="fas fa-book"></i> Tous les modules</h2>
                <p>Explorez tous nos modules d'apprentissage par tranche d'âge</p>
            </div>

            <!-- Filtres pour les modules -->
            <div class="modules-filters">
                <div class="filter-tabs">
                    <button class="filter-tab active" data-age="all">Tous</button>
                    <button class="filter-tab" data-age="6-8">6-8 ans</button>
                    <button class="filter-tab" data-age="9-11">9-11 ans</button>
                    <button class="filter-tab" data-age="12-14">12-14 ans</button>
                    <button class="filter-tab" data-age="15+">15+ ans</button>
                </div>
                <div class="search-filter">
                    <input type="text" placeholder="Rechercher un module...">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <!-- Liste des modules -->
            <div class="modules-grid">
                <!-- 6-8 ans -->
                <div class="module-large-card" data-age="6-8">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-globe-americas"></i>
                        </div>
                        <div class="module-large-badge">6-8 ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Découverte des continents</h3>
                        <p>Apprends à reconnaître les continents et leurs caractéristiques principales</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.8</span>
                            <span><i class="fas fa-users"></i> 1,245 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 75%"></div>
                            <span>75% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>

                <div class="module-large-card" data-age="6-8">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <div class="module-large-badge">6-8 ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Les animaux du monde</h3>
                        <p>Découvre les animaux de chaque continent et leur habitat naturel</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.9</span>
                            <span><i class="fas fa-users"></i> 1,567 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 40%"></div>
                            <span>40% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>

                <!-- 9-11 ans -->
                <div class="module-large-card" data-age="9-11">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-mountain"></i>
                        </div>
                        <div class="module-large-badge">9-11 ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Géographie avancée</h3>
                        <p>Explore les pays, capitales et reliefs des différents continents</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.7</span>
                            <span><i class="fas fa-users"></i> 987 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 60%"></div>
                            <span>60% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>

                <div class="module-large-card" data-age="9-11">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <div class="module-large-badge">9-11 ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Histoire des civilisations</h3>
                        <p>Découvre les grandes civilisations qui ont marqué l'histoire</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.6</span>
                            <span><i class="fas fa-users"></i> 856 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 25%"></div>
                            <span>25% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>

                <!-- 12-14 ans -->
                <div class="module-large-card" data-age="12-14">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <div class="module-large-badge">12-14 ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Sciences et découvertes</h3>
                        <p>Explore les grandes découvertes scientifiques et leurs impacts</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.8</span>
                            <span><i class="fas fa-users"></i> 723 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 30%"></div>
                            <span>30% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>

                <div class="module-large-card" data-age="12-14">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="module-large-badge">12-14 ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Géopolitique mondiale</h3>
                        <p>Comprends les enjeux politiques et économiques entre les pays</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.5</span>
                            <span><i class="fas fa-users"></i> 645 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 15%"></div>
                            <span>15% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>

                <!-- 15+ ans -->
                <div class="module-large-card" data-age="15+">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="module-large-badge">15+ ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Histoire contemporaine</h3>
                        <p>Analyse les événements majeurs du 20ème et 21ème siècle</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.9</span>
                            <span><i class="fas fa-users"></i> 512 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 50%"></div>
                            <span>50% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>

                <div class="module-large-card" data-age="15+">
                    <div class="module-large-header">
                        <div class="module-large-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="module-large-badge">15+ ans</div>
                    </div>
                    <div class="module-large-content">
                        <h3>Économie mondiale</h3>
                        <p>Comprends les mécanismes économiques et les enjeux mondiaux</p>
                        <div class="module-large-meta">
                            <span><i class="fas fa-star"></i> 4.7</span>
                            <span><i class="fas fa-users"></i> 478 joueurs</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 10%"></div>
                            <span>10% complété</span>
                        </div>
                        <button class="btn-module">Continuer</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Navigation mobile style WhatsApp -->
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
                <li>
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

        <!-- Navigation desktop (tabs en haut) -->
        <nav class="desktop-nav">
            <ul>
                <li><a href="/"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="/jeux"><i class="fas fa-gamepad"></i> Jeux</a></li>
                <li><a href="/profile"><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="/ligue"><i class="fas fa-trophy"></i> Ligues</a></li>
                <li><a href="/parametres"><i class="fas fa-cog"></i> Paramètres</a></li>
            </ul>
        </nav>
    </div>


</body>
</html>
