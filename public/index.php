<?php
  session_start();
  require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

  use App\Models\Database\Database; 
  use AltoRouter as Route;  
  
  $routes = new Route();
  $databse = new Database("mysql:host","3306","QuizWorld","root","");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if($_SERVER['REQUEST_URI'] === "/"): ?>
             Le Monde Dans Ma Poche - Quiz
        <?php else: ?>
            <?= ltrim($_SERVER['REQUEST_URI'],"/") ?>
        <?php endif?>
    </title>
    
     <!-- <link rel="stylesheet" href="/css/style.css"> -->
     <!-- <link rel="stylesheet" href="/css/styles.css"> -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- <script src="/js/script.js" defer></script> -->
    <!-- <script src="/js/auth.js" defer></script> -->
    <!-- <script src="/js/welcome.js" defer></script> -->
</head>
<body class="dark-theme">
    <div class="app-container">
        <!-- Sidebar pour Desktop -->
       <?php
            if($_SERVER['REQUEST_URI'] !== "/" && $_SERVER['REQUEST_URI'] !== "/login" && $_SERVER['REQUEST_URI'] !== "/register" &&  $_SERVER['REQUEST_URI'] !== "/administration/dashboard"){
             //require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'sidebar.php';
            }
            require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php';
       ?>
        <?php
        //                echo "<pre>";
        //  var_dump(
        //     $_SESSION
        //  );
        // echo "</pre>";


        //          echo "<pre>";
        //  var_dump(
        //     $_COOKIE
        //  );
        // echo "</pre>";
             
          die();
        ?>
        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header mobile -->
            <header class="mobile-header">
                <img src="img/logo.png" alt="Logo" class="logo">
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
                            <p>1,250</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-trophy"></i>
                        <div>
                            <h3>Trophées</h3>
                            <p>8</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3>Temps de jeu</h3>
                            <p>12h 30m</p>
                        </div>
                    </div>
                </section>

                <section class="explore-section">
                    <div class="section-header">
                        <h2>Explorer</h2>
                        <a href="#" class="see-all">Voir tout <i class="fas fa-chevron-right"></i></a>
                    </div>
                    
                    <div class="grid-container">
                        <div class="slide-container">
                            <div class="slide">
                                <img src="img/geography.jpg" alt="Géographie">
                                <div class="slide-content">
                                    <h3>Géographie</h3>
                                    <p>Découvrez les pays et les continents</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <div class="slide">
                                <img src="img/history.jpg" alt="Histoire">
                                <div class="slide-content">
                                    <h3>Histoire</h3>
                                    <p>Voyagez à travers les époques</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <div class="slide">
                                <img src="img/science.jpg" alt="Sciences">
                                <div class="slide-content">
                                    <h3>Sciences</h3>
                                    <p>Explorez les mystères de la nature</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <div class="slide">
                                <img src="img/culture.jpg" alt="Culture">
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
                        <a href="#" class="see-all">Voir tout <i class="fas fa-chevron-right"></i></a>
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
                <li class="active">
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
    </div>
</body>
</html>
