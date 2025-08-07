<?php
use App\Models\Jeu\Jeu;
use App\Models\JeuModel\JeuModel;

?>
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
           require (__DIR__) . '/templates/sidebar.php';
        ?>
        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header mobile -->
            <header class="mobile-header">
                <img src="/assets/logo.jpeg" alt="Logo" class="logo">
                <h1>Jeux</h1>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Contenu de la page jeux -->
            <div class="games-content">
                <section class="games-filters"  id="filter-categories">
                    <div class="filter-group">
                        <label>Catégorie</label>
                        <div class="filter-options">
                            <button class="filter-btn active" data-category="">Tous</button>
                            <?php foreach (App\Models\Category\Category::getAll() as $cat): ?>
                            <button class="filter-btn" data-category="<?= htmlspecialchars($cat['id_categorie'] ?? '') ?>">
                                <?= htmlspecialchars($cat['categorie'] ?? '') ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="filter-group" id="filter-ages">
                        <label>Âge</label>
                        <div class="filter-options">
                            <button class="filter-btn active">Tous</button>
                            <button class="filter-btn">6-8</button>
                            <button class="filter-btn">9-11</button>
                            <button class="filter-btn">12-14</button>
                            <button class="filter-btn">15+</button>
                        </div>
                    </div>
                    <!-- <div class="filter-group">
                        <label>Difficulté</label>
                        <div class="filter-options">
                            <button class="filter-btn active">Tous</button>
                            <button class="filter-btn">Facile</button>
                            <button class="filter-btn">Moyen</button>
                            <button class="filter-btn">Difficile</button>
                        </div>
                    </div> -->
                </section>

                <section class="games-grid">
                    <?php foreach(JeuModel::getAll() as $jeu): ?>
                    <div class="game-card"  data-category="<?= htmlspecialchars($jeu['id_categorie'] ?? '') ?>" data-age="<?= htmlspecialchars($jeu['age'] ?? '') ?>">
                        <div class="game-image">
                            <img src="<?= htmlspecialchars($jeu['slug_img'] ?? 'img/placeholder.svg') ?>" alt="Quiz <?= htmlspecialchars($jeu['titre'] ?? '') ?>">
                            <div class="game-badge"><?= htmlspecialchars($jeu['age'] ?? '') ?></div>
                        </div>
                        <div class="game-info">
                            <h3><?= htmlspecialchars($jeu['titre'] ?? '') ?></h3>
                            <p><?= htmlspecialchars($jeu['description'] ?? '') ?></p>
                            <div class="game-meta">
                                <span><i class="fas fa-layer-group"></i> <?= htmlspecialchars($jeu['categorie'] ?? '') ?></span>
                                <span><i class="fas fa-clock"></i> <?= htmlspecialchars($jeu['duration'] ?? '') ?></span>
                            </div>
                            <a  href="/user/jeu/<?= htmlspecialchars($jeu['id_jeu']) ?>">
                                <button  class="btn-play"> Jouer</button>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </section>
            </div>
        </main>

        <!-- Navigation mobile -->
        <?php 
             require __DIR__ . '/templates/mobile.php';
        ?>
    </div>
<script>
    let selectedCategory = '';
let selectedAge = 'Tous';

// Filtre catégorie
document.querySelectorAll('#filter-categories .filter-btn[data-category]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('#filter-categories .filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        selectedCategory = this.getAttribute('data-category') || '';
        filterGames();
    });
});

// Filtre âge
document.querySelectorAll('#filter-ages .filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('#filter-ages .filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        selectedAge = this.textContent.trim();
        filterGames();
    });
});

function filterGames() {
    document.querySelectorAll('.games-grid .game-card').forEach(card => {
        const cat = card.getAttribute('data-category') || '';
        const age = card.getAttribute('data-age') || '';
        let show = true;
        if (selectedCategory && cat !== selectedCategory) show = false;
        if (selectedAge !== 'Tous' && age !== selectedAge) show = false;
        card.style.display = show ? '' : 'none';
    });
}
</script>
    <script src="/js/script.js" defer></script>
</body>
</html>
