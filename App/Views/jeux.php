<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/styles.css">
      <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles pour les filtres */
.games-filters {
    background: var(--card-bg);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.filter-group {
    margin-bottom: 20px;
}

.filter-group:last-child {
    margin-bottom: 0;
}

.filter-group label {
    display: block;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 10px;
    font-size: 14px;
}

.filter-options {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.filter-btn {
    background: var(--bg-secondary);
    border: 2px solid transparent;
    border-radius: 20px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.filter-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.filter-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
}

/* Styles pour les résultats */
.results-info {
    margin-bottom: 20px;
    padding: 15px 20px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 12px;
    color: white;
}

.results-count {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    font-size: 14px;
}

.results-count i {
    font-size: 16px;
}

/* Styles pour "aucun résultat" */
.no-results {
    display: none;
    justify-content: center;
    align-items: center;
    min-height: 300px;
    grid-column: 1 / -1;
}

.no-results-content {
    text-align: center;
    color: var(--text-secondary);
}

.no-results-content i {
    font-size: 48px;
    color: var(--text-muted);
    margin-bottom: 20px;
}

.no-results-content h3 {
    color: var(--text-primary);
    margin-bottom: 10px;
    font-size: 24px;
}

.no-results-content p {
    margin-bottom: 25px;
    font-size: 16px;
}

.btn-reset-filters {
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 25px;
    padding: 12px 24px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-reset-filters:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(74, 144, 226, 0.3);
}

/* Animations */
.fade-in {
    animation: fadeInUp 0.5s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .games-filters {
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .filter-options {
        gap: 6px;
    }
    
    .filter-btn {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .results-info {
        padding: 12px 15px;
        margin-bottom: 15px;
    }
    
    .results-count {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .filter-group label {
        font-size: 13px;
    }
    
    .filter-btn {
        padding: 5px 10px;
        font-size: 11px;
    }
    
    .no-results-content h3 {
        font-size: 20px;
    }
    
    .no-results-content p {
        font-size: 14px;
    }
}

    </style>
</head>
<body class="dark-theme">
    <div class="app-container">
        <!-- Sidebar pour Desktop -->
        <?php
           require __DIR__ . '/sidebar.php';
        ?>
        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header mobile -->
            <header class="mobile-header">
                <img src="img/logo.png" alt="Logo" class="logo">
                <h1>Jeux</h1>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Contenu de la page jeux -->
            <div class="games-content">
                <section class="games-filters">
                    <div class="filter-group">
                        <label>Catégorie</label>
                        <div class="filter-options">
                            <button class="filter-btn active">Tous</button>
                            <button class="filter-btn">Géographie</button>
                            <button class="filter-btn">Histoire</button>
                            <button class="filter-btn">Sciences</button>
                            <button class="filter-btn">Culture</button>
                        </div>
                    </div>
                    <div class="filter-group">
                        <label>Âge</label>
                        <div class="filter-options">
                            <button class="filter-btn active">Tous</button>
                            <button class="filter-btn">6-8 ans</button>
                            <button class="filter-btn">9-11 ans</button>
                            <button class="filter-btn">12-14 ans</button>
                            <button class="filter-btn">15+ ans</button>
                        </div>
                    </div>
                    <div class="filter-group">
                        <label>Difficulté</label>
                        <div class="filter-options">
                            <button class="filter-btn active">Tous</button>
                            <button class="filter-btn">Facile</button>
                            <button class="filter-btn">Moyen</button>
                            <button class="filter-btn">Difficile</button>
                        </div>
                    </div>
                </section>

                <section class="games-grid">
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game1.jpg" alt="Quiz Géographie">
                            <div class="game-badge">6-8 ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Géographie: Europe</h3>
                            <p>Découvre les pays et capitales d'Europe</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.8</span>
                                <span><i class="fas fa-clock"></i> 10 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
                        </div>
                    </div>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game2.jpg" alt="Quiz Histoire">
                            <div class="game-badge">9-11 ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Histoire: Moyen Âge</h3>
                            <p>Voyage dans le temps à l'époque médiévale</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.6</span>
                                <span><i class="fas fa-clock"></i> 15 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
                        </div>
                    </div>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game3.jpg" alt="Quiz Sciences">
                            <div class="game-badge">12-14 ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Sciences: Espace</h3>
                            <p>Explore les mystères de l'univers</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.9</span>
                                <span><i class="fas fa-clock"></i> 12 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
                        </div>
                    </div>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game4.jpg" alt="Quiz Culture">
                            <div class="game-badge">15+ ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Culture: Asie</h3>
                            <p>Découvre les traditions et coutumes asiatiques</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.7</span>
                                <span><i class="fas fa-clock"></i> 20 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
                        </div>
                    </div>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game5.jpg" alt="Quiz Géographie">
                            <div class="game-badge">6-8 ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Géographie: Afrique</h3>
                            <p>Découvre les pays et paysages d'Afrique</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.5</span>
                                <span><i class="fas fa-clock"></i> 10 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
                        </div>
                    </div>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game6.jpg" alt="Quiz Histoire">
                            <div class="game-badge">9-11 ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Histoire: Antiquité</h3>
                            <p>Découvre les civilisations anciennes</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.4</span>
                                <span><i class="fas fa-clock"></i> 15 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
                        </div>
                    </div>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game7.jpg" alt="Quiz Sciences">
                            <div class="game-badge">12-14 ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Sciences: Animaux</h3>
                            <p>Découvre le monde fascinant des animaux</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.8</span>
                                <span><i class="fas fa-clock"></i> 12 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
                        </div>
                    </div>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="img/game8.jpg" alt="Quiz Culture">
                            <div class="game-badge">15+ ans</div>
                        </div>
                        <div class="game-info">
                            <h3>Quiz Culture: Amérique</h3>
                            <p>Explore les cultures du continent américain</p>
                            <div class="game-meta">
                                <span><i class="fas fa-star"></i> 4.6</span>
                                <span><i class="fas fa-clock"></i> 20 min</span>
                            </div>
                            <button class="btn-play">Jouer</button>
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
                <li class="active">
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

    <script src="/js/script.js" defer></script>
    <script>
    // Remplace le comportement des boutons 'Jouer' pour utiliser l'API
    const playButtons = document.querySelectorAll('.btn-play');
    if (playButtons.length > 0) {
        playButtons.forEach((button, idx) => {
            button.addEventListener('click', function () {
                // L'index du jeu correspond à l'id simulé (1-based)
                const jeuId = idx + 1;
                fetch(`/api/jeu/${jeuId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.id) {
                            // Redirige vers la page de démarrage du jeu avec les infos en paramètres
                            const params = new URLSearchParams({
                                categorie: data.categorie,
                                age: data.age,
                                titre: data.titre,
                                desc: data.desc,
                                img: data.img
                            });
                            window.location.href = `/user/start-game?${params.toString()}`;
                        } else {
                            alert('Jeu non trouvé !');
                        }
                    })
                    .catch(() => alert('Erreur lors de la récupération du jeu.'));
            });
        });
    }
    </script>
</body>
</html>
