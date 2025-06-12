<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorations - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/exploration.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="dark-theme">
    <div class="app-container">
        <main class="main-content">
            <div class="page-header">
                <h2><i class="fas fa-compass"></i> Toutes les explorations</h2>
                <p>Découvrez le monde à travers nos différentes thématiques d'exploration</p>
            </div>

            <!-- Filtres pour les explorations -->
            <div class="explorations-filters">
                <div class="filter-tabs">
                    <button class="filter-tab active" data-category="all">
                        Tous
                    </button>
                    <button class="filter-tab" data-category="geography">
                        Géographie
                    </button>
                    <button class="filter-tab" data-category="history">
                      Histoire
                    </button>
                    <button class="filter-tab" data-category="science">Sciences</button>
                    <button class="filter-tab" data-category="culture">Culture</button>
                </div>
                <div class="search-filter">
                    <input type="text" placeholder="Rechercher une exploration...">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <!-- Liste des explorations -->
            <div class="explorations-grid">
                <!-- Géographie -->
                <div class="exploration-card" data-category="geography">
                    <div class="exploration-image">
                        <img src="img/europe.jpg" alt="Europe">
                        <div class="exploration-badge geography">Géographie</div>
                    </div>
                    <div class="exploration-content">
                        <h3>L'Europe</h3>
                        <p>Découvre les pays, capitales et cultures du continent européen</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-map-marker-alt"></i> 45 pays</span>
                            <span><i class="fas fa-clock"></i> 3h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <div class="exploration-card" data-category="geography">
                    <div class="exploration-image">
                        <img src="img/africa.jpg" alt="Afrique">
                        <div class="exploration-badge geography">Géographie</div>
                    </div>
                    <div class="exploration-content">
                        <h3>L'Afrique</h3>
                        <p>Explore la diversité des paysages et cultures africaines</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-map-marker-alt"></i> 54 pays</span>
                            <span><i class="fas fa-clock"></i> 4h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <div class="exploration-card" data-category="geography">
                    <div class="exploration-image">
                        <img src="img/asia.jpg" alt="Asie">
                        <div class="exploration-badge geography">Géographie</div>
                    </div>
                    <div class="exploration-content">
                        <h3>L'Asie</h3>
                        <p>Découvre le plus grand continent du monde et ses civilisations</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-map-marker-alt"></i> 48 pays</span>
                            <span><i class="fas fa-clock"></i> 5h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <!-- Histoire -->
                <div class="exploration-card" data-category="history">
                    <div class="exploration-image">
                        <img src="img/ancient.jpg" alt="Antiquité">
                        <div class="exploration-badge history">Histoire</div>
                    </div>
                    <div class="exploration-content">
                        <h3>L'Antiquité</h3>
                        <p>Voyage dans le temps à la découverte des premières civilisations</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-landmark"></i> 5 civilisations</span>
                            <span><i class="fas fa-clock"></i> 3h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <div class="exploration-card" data-category="history">
                    <div class="exploration-image">
                        <img src="img/medieval.jpg" alt="Moyen Âge">
                        <div class="exploration-badge history">Histoire</div>
                    </div>
                    <div class="exploration-content">
                        <h3>Le Moyen Âge</h3>
                        <p>Découvre la vie au temps des châteaux forts et des chevaliers</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-landmark"></i> 10 périodes</span>
                            <span><i class="fas fa-clock"></i> 4h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <!-- Sciences -->
                <div class="exploration-card" data-category="science">
                    <div class="exploration-image">
                        <img src="img/space.jpg" alt="Espace">
                        <div class="exploration-badge science">Sciences</div>
                    </div>
                    <div class="exploration-content">
                        <h3>L'Espace</h3>
                        <p>Explore les mystères de l'univers, des planètes aux galaxies</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-planet-ringed"></i> 8 planètes</span>
                            <span><i class="fas fa-clock"></i> 3h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <div class="exploration-card" data-category="science">
                    <div class="exploration-image">
                        <img src="img/animals.jpg" alt="Animaux">
                        <div class="exploration-badge science">Sciences</div>
                    </div>
                    <div class="exploration-content">
                        <h3>Le Règne Animal</h3>
                        <p>Découvre la diversité des espèces animales sur notre planète</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-paw"></i> 100+ espèces</span>
                            <span><i class="fas fa-clock"></i> 4h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <!-- Culture -->
                <div class="exploration-card" data-category="culture">
                    <div class="exploration-image">
                        <img src="img/food.jpg" alt="Cuisine">
                        <div class="exploration-badge culture">Culture</div>
                    </div>
                    <div class="exploration-content">
                        <h3>Cuisines du Monde</h3>
                        <p>Voyage culinaire à travers les saveurs des cinq continents</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-utensils"></i> 50 plats</span>
                            <span><i class="fas fa-clock"></i> 3h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>

                <div class="exploration-card" data-category="culture">
                    <div class="exploration-image">
                        <img src="img/festivals.jpg" alt="Festivals">
                        <div class="exploration-badge culture">Culture</div>
                    </div>
                    <div class="exploration-content">
                        <h3>Fêtes et Traditions</h3>
                        <p>Découvre les célébrations et traditions à travers le monde</p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-calendar-day"></i> 30 fêtes</span>
                            <span><i class="fas fa-clock"></i> 3h</span>
                        </div>
                        <button class="btn-explore">Explorer</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Navigation mobile style WhatsApp -->
        <nav class="mobile-nav">
            <ul>
                <li>
                    <a href="/">
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
