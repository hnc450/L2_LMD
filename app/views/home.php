<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>


<body>
<?php 
     require __DIR__.'/sidebar.php';
?>
<main class="main-content">
    
            <!-- Header mobile -->
            <header class="mobile-header">
                <img src="/assets/logo.jpeg" alt="Logo" class="logo">
                <h1>Le Monde Dans Ma Poche</h1>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Contenu de la page d'accueil -->
            <div class="home-content">
                <section class="user-stats">
                    <div class="stat-card">
                        <i class="fas fa-star"></i>
                        <div>
                            <h3>Points</h3>
                            <p> <?= $_SESSION['points'] ?? '0'?> </p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-trophy"></i>
                        <div>
                            <h3>Trophées</h3>
                            <p><?= $_SESSION['user']['trophies'] ?? '0'?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3>Temps de jeu</h3>
                            <p><?= $_SESSION['user']['temps'] ?? '0'?>s</p>
                        </div>
                    </div>
                </section>

                <section class="explore-section">
                    <div class="section-header">
                        <h2>Explorer</h2>
                        <a href="/user/explorations" class="see-all">Voir tout <i class="fas fa-chevron-right"></i></a>
                    </div>
                    
                    <div class="grid-container">
                        <div class="slide-container">
                            <div class="slide">
                                <img src="/assets/geography.jpeg" alt="Géographie">
                                <div class="slide-content">
                                    <h3>Géographie</h3>
                                    <p>Découvrez les pays et les continents</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <div class="slide">
                                <img src="/assets/history.jpeg" alt="Histoire">
                                <div class="slide-content">
                                    <h3>Histoire</h3>
                                    <p>Voyagez à travers les époques</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <div class="slide">
                                <img src="/assets/science.jpeg" alt="Sciences">
                                <div class="slide-content">
                                    <h3>Sciences</h3>
                                    <p>Explorez les mystères de la nature</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <div class="slide">
                                <img src="/assets/culture.jpeg" alt="Culture">
                                <div class="slide-content">
                                    <h3>Culture</h3>
                                    <p>Découvrez les traditions du monde</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="modules-section">
                    <div class="section-header">
                        <h2>Modules par âge</h2>
                        <a href="/user/modules" class="see-all">Voir tout <i class="fas fa-chevron-right"></i></a>
                    </div>
                    
                    <div class="modules-container">
                        <div class="module-card">
                            <div class="module-icon">
                                <i class="fas fa-child"></i>
                            </div>
                            <div class="module-info">
                                <h3>6-8 ans</h3>
                                <p>Découverte du monde</p>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="module-card">
                            <div class="module-icon">
                                <i class="fas fa-child"></i>
                            </div>
                            <div class="module-info">
                                <h3>9-11 ans</h3>
                                <p>Exploration avancée</p>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 45%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="module-card">
                            <div class="module-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="module-info">
                                <h3>12-14 ans</h3>
                                <p>Connaissances intermédiaires</p>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="module-card">
                            <div class="module-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="module-info">
                                <h3>15+ ans</h3>
                                <p>Expertise mondiale</p>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 15%"></div>
                                </div>
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
<script src="/js/script.js" ></script>
</body>

