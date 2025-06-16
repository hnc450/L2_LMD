<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Contenu - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/popup.css">
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
                        Nouveau Quiz
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
                            <h3>Quiz Actifs</h3>
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
                        <button class="tab-btn active" data-tab="quiz">Quiz</button>
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
                                        <th>Niveau</th>
                                        <th>Questions</th>
                                        <th>Statut</th>
                                        <th>Créé le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="content-title">
                                                <img src="img/geography.jpg" alt="Quiz" class="content-thumb">
                                                <span>Capitales d'Europe</span>
                                            </div>
                                        </td>
                                        <td><span class="category-badge geography">Géographie</span></td>
                                        <td>9-11 ans</td>
                                        <td>15</td>
                                        <td><span class="status-badge active">Actif</span></td>
                                        <td>15/11/2024</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-icon edit" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-icon view" title="Prévisualiser">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-icon delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="content-title">
                                                <img src="img/history.jpg" alt="Quiz" class="content-thumb">
                                                <span>Rois de France</span>
                                            </div>
                                        </td>
                                        <td><span class="category-badge history">Histoire</span></td>
                                        <td>12-14 ans</td>
                                        <td>20</td>
                                        <td><span class="status-badge draft">Brouillon</span></td>
                                        <td>14/11/2024</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-icon edit" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-icon view" title="Prévisualiser">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-icon delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="content-title">
                                                <img src="img/science.jpg" alt="Quiz" class="content-thumb">
                                                <span>Système Solaire</span>
                                            </div>
                                        </td>
                                        <td><span class="category-badge science">Sciences</span></td>
                                        <td>6-8 ans</td>
                                        <td>12</td>
                                        <td><span class="status-badge active">Actif</span></td>
                                        <td>13/11/2024</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-icon edit" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-icon view" title="Prévisualiser">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-icon delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
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
                        <div class="explorations-admin-grid">
                            <div class="exploration-admin-card">
                                <div class="exploration-image">
                                    <img src="img/geography.jpg" alt="Exploration">
                                    <div class="exploration-badge geography">Géographie</div>
                                </div>
                                <div class="exploration-content">
                                    <h3>L'Europe</h3>
                                    <p>Découverte des pays européens</p>
                                    <div class="exploration-stats">
                                        <span><i class="fas fa-eye"></i> 2,456 vues</span>
                                        <span><i class="fas fa-clock"></i> 3h moyenne</span>
                                    </div>
                                    <div class="exploration-actions">
                                        <button class="btn-small edit">Modifier</button>
                                        <button class="btn-small analytics">Analytics</button>
                                    </div>
                                </div>
                            </div>
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

    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/include.js"></script>
    <script src="../assets/js/popup.js"></script>
</body>
</html>
