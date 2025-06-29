<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorations - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/exploration.js" defer></script>
    <script src="/js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="app-container">
        <?php
           require __DIR__ . '/sidebar.php';
        ?>
        <main class="main-content">
            <div class="page-header">
                <h2><i class="fas fa-compass"></i> Toutes les explorations</h2>
                <p>Découvrez le monde à travers nos différentes thématiques d'exploration</p>
            </div>

            <!-- Filtres pour les explorations -->
            <div class="explorations-filters">
                <div class="filter-tabs">
                   
                    <button class="filter-tab active" data-category="all">
                         All
                    </button>
                    <?php foreach(\App\Models\Category\Category::categories() as $category): ?>
                    <button class="filter-tab" data-category="<?= $category['categorie'] ?>">
                        <?= $category['categorie'] ?>
                    </button>
                    <?php endforeach; ?>
                </div>
                <div class="search-filter">
                    <input type="text" placeholder="Rechercher une exploration...">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <!-- Liste des explorations -->
            <div class="explorations-grid">
                <!-- test de la recuperation des explorations -->
                <?php foreach(\App\Models\Exploration\Exploration::getAll() as $explorations): ?>
                <div class="exploration-card" data-category="<?= $explorations['categorie'] ?>">
                    <div class="exploration-image">
                        <img src="<?= $explorations['slug'] ?>" alt="<?= $explorations['titre'] ?>">
                        <div class="exploration-badge geography"><?= $explorations['categorie'] ?></div>
                    </div>
                    <div class="exploration-content">
                        <h3><?=$explorations['titre'] ?></h3>
                        <p><?=$explorations['description'] ?></p>
                        <div class="exploration-meta">
                            <span><i class="fas fa-map-marker-alt"></i> <?=$explorations['categorie'] ?></span>
                            <span><i class="fas fa-clock"></i> 3h</span>
                        </div>
                       
                        <a href="/user/exploration/start/<?= $explorations['id']?>">
                               <button class="btn-explore">Explorer</button>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
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
