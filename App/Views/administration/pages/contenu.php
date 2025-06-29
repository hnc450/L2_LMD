<?php 
   \App\Middlewares\Security\Security::require_auth();
   use App\Models\Jeu\Jeu;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Contenu - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <img src="img/logo.png" alt="Logo" class="logo">
                    <h1>Gestion du Contenu</h1>
                </div>
                <div class="header-right">
                    <!-- Theme Toggle will be loaded here -->
                    <div class="theme-toggle-container"></div>
                    <div class="user-info-header">
                        <img src="img/avatar.png" alt="Avatar" class="avatar">
                        <div>
                            <p class="username">Admin</p>
                            <p class="rank">Administrateur</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Page Header -->
                <div class="page-header">
                    <h2><i class="fas fa-edit"></i> Gestion du Contenu</h2>
                    <p>Créez et gérez les quiz, modules et explorations</p>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <button class="action-btn primary">
                        <i class="fas fa-plus"></i>
                        Nouveau Jeu
                    </button>
                    <button class="action-btn secondary">
                        <i class="fas fa-book"></i>
                        Nouveau Module
                    </button>
                    <button class="action-btn tertiary">
                        <i class="fas fa-compass"></i>
                        Nouvelle Exploration
                    </button>
                    <button class="action-btn quaternary">
                        <i class="fas fa-upload"></i>
                        Importer Contenu
                    </button>
                </div>

                <!-- Content Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon quiz">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Jeu</h3>
                            <p class="stat-number">156</p>
                            <span class="stat-change positive">+12 cette semaine</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon module">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Modules</h3>
                            <p class="stat-number">24</p>
                            <span class="stat-change positive">+3 ce mois</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon exploration">
                            <i class="fas fa-compass"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Explorations</h3>
                            <p class="stat-number">18</p>
                            <span class="stat-change neutral">Aucun changement</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>En Attente</h3>
                            <p class="stat-number">7</p>
                            <span class="stat-change negative">Nécessite révision</span>
                        </div>
                    </div>
                </div>

                <!-- Content Management Tabs -->
                <div class="content-tabs">
                    <div class="tab-buttons">
                        <button class="tab-btn active" data-tab="quiz">Jeu</button>
                        <button class="tab-btn" data-tab="modules">Modules</button>
                        <button class="tab-btn" data-tab="explorations">Explorations</button>
                        <button class="tab-btn" data-tab="media">Médias</button>
                    </div>

                    <!-- Quiz Tab -->
                    <div class="tab-content active" id="quiz-tab">
                        <div class="content-header">
                            <div class="search-filter">
                                <input type="text" placeholder="Rechercher un quiz...">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="filter-options">
                                <select class="filter-select">
                                    <option>Toutes les catégories</option>
                                    <option>Géographie</option>
                                    <option>Histoire</option>
                                    <option>Sciences</option>
                                    <option>Culture</option>
                                </select>
                                <select class="filter-select">
                                    <option>Tous les niveaux</option>
                                    <option>6-8 ans</option>
                                    <option>9-11 ans</option>
                                    <option>12-14 ans</option>
                                    <option>15+ ans</option>
                                </select>
                            </div>
                        </div>

                        <div class="content-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Age</th>
                                        <!-- <th>Questions</th> -->
                                        <!-- <th>Statut</th> -->
                                        <th>Date de publication</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach(Jeu::recuperer_tous_les_jeux() as $jeu): ?>
                                       
                                    <tr>
                                        <td>
                                            <div class="content-title">
                                                <img src="<?= htmlspecialchars($jeu['slug_img'] ?? 'img/placeholder.svg') ?>" alt="Quiz" class="content-thumb">
                                                <span><?= htmlspecialchars($jeu['titre'] ?? '') ?></span>
                                            </div>
                                        </td>
                                        <td><span class="category-badge"><?= htmlspecialchars($jeu['categorie'] ?? '') ?></span></td>
                                        <td><?= htmlspecialchars($jeu['age'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($jeu['date_post'] ?? '') ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-icon edit" title="Modifier" data-id="<?= htmlspecialchars($jeu['id_jeu'] ?? '') ?>" data-type="quiz">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-icon view" title="Prévisualiser" data-id="<?= htmlspecialchars($jeu['id_jeu'] ?? '') ?>" data-type="quiz">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-icon delete" title="Supprimer" data-id="<?= htmlspecialchars($jeu['id_jeu'] ?? '') ?>" data-type="quiz">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination">
                            <button class="pagination-btn" disabled>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <span class="pagination-info">Page 1 sur 5</span>
                            <button class="pagination-btn">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modules Tab -->
                    <div class="tab-content" id="modules-tab">
                        <div class="modules-grid">

                            <div class="module-card-admin">
                                <div class="module-header">
                                    <img src="img/geography.jpg" alt="Module">
                                    <div class="module-status active">Actif</div>
                                </div>
                                <div class="module-content">
                                    <h3>Découverte des Continents</h3>
                                    <p>Module d'introduction à la géographie mondiale</p>
                                    <div class="module-meta">
                                        <span><i class="fas fa-users"></i> 1,245 utilisateurs</span>
                                        <span><i class="fas fa-star"></i> 4.8/5</span>
                                    </div>
                                    <div class="module-actions">
                                        <button class="btn-small edit">Modifier</button>
                                        <button class="btn-small view">Voir</button>
                                        <button class="btn-small stats">Stats</button>
                                    </div>
                                </div>
                            </div>

                            <div class="module-card-admin">
                                <div class="module-header">
                                    <img src="img/history.jpg" alt="Module">
                                    <div class="module-status draft">Brouillon</div>
                                </div>
                                <div class="module-content">
                                    <h3>Histoire Contemporaine</h3>
                                    <p>Les événements majeurs du 20ème siècle</p>
                                    <div class="module-meta">
                                        <span><i class="fas fa-users"></i> 0 utilisateurs</span>
                                        <span><i class="fas fa-star"></i> -/5</span>
                                    </div>
                                    <div class="module-actions">
                                        <button class="btn-small edit">Modifier</button>
                                        <button class="btn-small publish">Publier</button>
                                        <button class="btn-small delete">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Explorations Tab -->
                    <div class="tab-content" id="explorations-tab">
                        <div class="modules-grid">
                            <?php foreach( \App\Models\Exploration\Exploration::getAll() as $exploration): ?>
                                <div class="module-card-admin">
                                    <div class="module-header">
                                        <img src="<?= htmlspecialchars($exploration['slug'] ?? 'img/placeholder.svg') ?>" alt="Exploration">
                                        <div class="module-status <?= ($exploration['statut'] ?? 'active') ?>">
                                            <?= ucfirst($exploration['statut'] ?? 'Actif') ?>
                                        </div>
                                    </div>
                                    <div class="module-content">
                                        <h3><?= htmlspecialchars($exploration['titre']) ?></h3>
                                        <p><?= htmlspecialchars($exploration['description'] ?? '') ?></p>
                                        <div class="module-meta">
                                            <span><i class="fas fa-tag"></i> <?= htmlspecialchars($exploration['categorie']) ?></span>
                                            <span><i class="fas fa-hashtag"></i> ID: <?= htmlspecialchars($exploration['id']) ?></span>
                                        </div>
                                        <div class="module-actions">
                                            <button class="btn-small edit" data-id="<?= htmlspecialchars($exploration['id']) ?>" data-type="exploration">Modifier</button>
                                            <button class="btn-small delete" data-id="<?= htmlspecialchars($exploration['id']) ?>" data-type="exploration">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Media Tab -->
                    <div class="tab-content" id="media-tab">
                        <div class="media-upload-area">
                            <div class="upload-zone">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h3>Glissez vos fichiers ici</h3>
                                <p>ou cliquez pour sélectionner</p>
                                <input type="file" multiple accept="image/*,video/*,audio/*">
                            </div>
                        </div>

                        <div class="media-grid">
                            <div class="media-item">
                                <img src="img/geography.jpg" alt="Media">
                                <div class="media-overlay">
                                    <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                    <button class="btn-icon"><i class="fas fa-download"></i></button>
                                    <button class="btn-icon"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="media-info">
                                    <span>geography.jpg</span>
                                    <small>2.3 MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>



    <!-- FORMULAIRES POPUP MASQUÉS -->
    <div id="form-quiz" style="display:none">
        <form id="contentFormQuiz" method="POST" action="/administration/add/quiz">
            <div class="form-group">
                <label for="title-quiz">Titre</label>
                <input type="text" id="title-quiz" required name="titre">
            </div>

            <div class="form-group">
                <label for="title-quiz">Image or Link-Image</label>
                <input type="text" id="slug-quiz" require name="slug">
            </div>

            <div class="form-group">
                <label for="title-quiz">Durée</label>
                <input type="text" id="slug-quiz" require name="duration">
            </div>

            <div class="form-group">
                <label for="description-quiz">Description</label>
                <textarea id="description-quiz" rows="3" name="description"></textarea>
            </div>
            
            <div class="form-group">
                <label for="contenu-quiz">Contenu</label>
                <textarea id="contenu-quiz" rows="3" name="contenu"></textarea>
            </div>

            <div class="form-group">
                <label for="category-quiz">Catégorie</label>
                <select id="category-quiz" required name="category">
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach(\App\Models\Category\Category::categories() as $category):?>
                     <option value="<?=$category['id_categorie']?>"><?=$category['categorie']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="level-quiz">Tranche d'age</label>
              
                <select id="level-quiz" required name="age">
                    <option value="">Sélectionner un niveau</option>
                    <option value="6-8">6-8 ans</option>
                    <option value="9-11">9-11 ans</option>
                    <option value="12-14">12-14 ans</option>
                    <option value="15+">15+ ans</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel">Annuler</button>
                <button type="submit" class="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>
    <div id="form-module" style="display:none">
        <form id="contentFormModule" method="POST" action="/administration/add/module">
            <div class="form-group">
                <label for="title-module">Titre</label>
                <input type="text" id="title-module" required>
            </div>
            <div class="form-group">
                <label for="description-module">Description</label>
                <textarea id="description-module" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="category-module">Catégorie</label>
                <select id="category-module" required>
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach(\App\Models\Category\Category::categories() as $category):?>
                    <option value="<?=$category['id_categorie']?>"><?=$category['categorie']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="level-module">Niveau</label>
                <select id="level-module" required>
                    <option value="">Sélectionner un niveau</option>
                    <option value="6-8">6-8 ans</option>
                    <option value="9-11">9-11 ans</option>
                    <option value="12-14">12-14 ans</option>
                    <option value="15+">15+ ans</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel">Annuler</button>
                <button type="submit" class="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>
    
    <div id="form-exploration" style="display:none">
        <form id="contentFormExploration" action="/administration/add/exploration" method="POST" >
            <div class="form-group">
                <label for="title-exploration">Titre</label>
                <input type="text" id="title-exploration" required name="titre">
            </div>
            <div class="form-group">
                <label for="title-exploration">Image</label>
                <input type="text" id="title-image" required placeholder="slug | image path" name="slug">
            </div>
            <div class="form-group">
                <label for="description-exploration">Description</label>
                <textarea id="description-exploration" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="description-exploration">Contenu</label>
                <textarea id="description-contenu" rows="3" placeholder="markdown" name="contenu"></textarea>
            </div>
            <div class="form-group">
                <label for="category-exploration">Catégorie</label>
                <select id="category-exploration" required name="categorie">
                  <option value="">Sélectionner une catégorie</option>
                <?php foreach(\App\Models\Category\Category::categories() as $category):?>
                    <option value="<?=$category['id_categorie']?>"><?=$category['categorie']?></option>
                <?php endforeach ?>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel">Annuler</button>
                <button type="submit" class="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>    


    <script src="/js/theme.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/popup.js"></script>
    <script src="/js/script.js" defer></script>
    <script src="/js/analytics.js"></script>
    <script src="/js/admin-dashboard.js"></script>
    <script>
    document.querySelectorAll('.btn-small.delete, .btn-icon.delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            let url = '';
            if (type === 'exploration') {
                url = `/administration/exploration/${id}`;
            } else if (type === 'module') {
                url = `/administration/module/${id}`;
            } else if (type === 'quiz') {
                url = `/administration/quiz/${id}`;
            }
            if (confirm('Voulez-vous vraiment supprimer cet élément ?')) {
                fetch(url, {
                    method: 'DELETE'
                })
                .then(res => {
                    if (res.ok) {
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                });
            }
        });
    });

    function modifierExploration(id, data) {
        fetch(`/administration/exploration/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => {
            if (res.ok) {
                location.reload();
            } else {
                alert('Erreur lors de la modification');
            }
        });
    }
    </script>
</body>
</html>
<?php
 require __DIR__ .'/view.php';
?>
