<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles spécifiques pour la page feedbacks */
        .feedback-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
            border: 1px solid var(--border-color);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.13);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.bug { background: var(--danger-color); }
        .stat-icon.suggestion { background: var(--info-color); }
        .stat-icon.complaint { background: var(--warning-color); }
        .stat-icon.resolved { background: var(--success-color); }

        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-color);
        }

        .stat-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .filters-section {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            align-items: center;
            margin-bottom: var(--spacing-lg);
            justify-content: space-between;
        }

        .search-filter {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            background: var(--card-bg);
            border-radius: var(--border-radius-md);
            padding: 0.5em 1em;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: box-shadow var(--transition-fast), transform var(--transition-fast);
            border: 1px solid var(--border-color);
            flex: 1;
            max-width: 400px;
        }

        .search-filter:hover, .search-filter:focus-within {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .search-filter input {
            border: none;
            background: transparent;
            color: var(--text-color);
            font-size: 1rem;
            outline: none;
            width: 100%;
            padding: 0.5em 0;
        }

        .search-filter i {
            color: var(--primary-color);
        }

        .filter-options {
            display: flex;
            gap: var(--spacing-md);
        }

        .filter-select {
            border-radius: var(--border-radius-md);
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: var(--text-color);
            padding: 0.5em 1em;
            font-size: 1rem;
            cursor: pointer;
            transition: box-shadow var(--transition-fast), transform var(--transition-fast);
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.7em center;
            background-size: 1em;
            padding-right: 2.5em;
        }

        .filter-select:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(var(--primary-rgb), 0.1);
        }

        .feedbacks-table {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .feedbacks-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .feedbacks-table th {
            background: var(--primary-light);
            color: white;
            font-weight: 600;
            text-align: left;
            padding: 1rem;
        }

        .feedbacks-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .feedbacks-table tr:last-child td {
            border-bottom: none;
        }

        .feedbacks-table tr:hover {
            background: rgba(var(--primary-rgb), 0.05);
        }

        .feedback-type {
            display: inline-flex;
            align-items: center;
            gap: 0.5em;
            padding: 0.3em 0.8em;
            border-radius: 1em;
            font-size: 0.9em;
            font-weight: 600;
            color: white;
        }

        .feedback-type.bug { background: var(--danger-color); }
        .feedback-type.suggestion { background: var(--info-color); }
        .feedback-type.complaint { background: var(--warning-color); }

        .feedback-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5em;
            padding: 0.3em 0.8em;
            border-radius: 1em;
            font-size: 0.9em;
            font-weight: 600;
            color: white;
        }

        .feedback-status.pending { background: var(--warning-color); }
        .feedback-status.in-progress { background: var(--info-color); }
        .feedback-status.resolved { background: var(--success-color); }

        .action-buttons {
            display: flex;
            gap: var(--spacing-sm);
        }

        .btn-icon {
            background: var(--primary-light);
            color: white;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background var(--transition-fast), transform var(--transition-fast);
        }

        .btn-icon.edit { background: var(--info-color); }
        .btn-icon.resolve { background: var(--success-color); }
        .btn-icon.delete { background: var(--danger-color); }

        .btn-icon:hover {
            transform: scale(1.12);
            filter: brightness(1.1);
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-lg);
        }

        .pagination-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 1rem;
            cursor: pointer;
            transition: background var(--transition-fast);
        }

        .pagination-btn.active, .pagination-btn:hover {
            background: var(--primary-dark);
        }

        .pagination-btn:disabled {
            background: var(--border-color);
            color: #aaa;
            cursor: not-allowed;
        }
    </style>
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
                    <h1>Feedbacks et Signalements</h1>
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

            <div class="dashboard-content">
                <!-- Stats Section -->
                <div class="feedback-stats">
                    <div class="stat-card">
                        <div class="stat-icon bug">
                            <i class="fas fa-bug"></i>
                        </div>
                        <div class="stat-info">
                            <h3>24</h3>
                            <p>Bugs signalés</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon suggestion">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="stat-info">
                            <h3>156</h3>
                            <p>Suggestions</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon complaint">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>8</h3>
                            <p>Plaintes</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon resolved">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>142</h3>
                            <p>Résolus</p>
                        </div>
                    </div>
                </div>

                <!-- Filtres et Recherche -->
                <div class="filters-section">
                    <div class="search-filter">
                        <input type="text" placeholder="Rechercher un feedback...">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option>Tous les types</option>
                            <option>Bug</option>
                            <option>Suggestion</option>
                            <option>Plainte</option>
                        </select>
                        <select class="filter-select">
                            <option>Tous les statuts</option>
                            <option>En attente</option>
                            <option>En cours</option>
                            <option>Résolu</option>
                        </select>
                    </div>
                </div>

                <!-- Liste des Feedbacks -->
                <div class="feedbacks-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Joueur</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="feedback-type bug">
                                        <i class="fas fa-bug"></i>
                                        Bug
                                    </span>
                                </td>
                                <td>Le jeu se bloque lors du chargement du niveau 3</td>
                                <td>Jean Dupont</td>
                                <td>01/03/2024</td>
                                <td>
                                    <span class="feedback-status pending">
                                        <i class="fas fa-clock"></i>
                                        En attente
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon edit" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon resolve" title="Résoudre">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="feedback-type suggestion">
                                        <i class="fas fa-lightbulb"></i>
                                        Suggestion
                                    </span>
                                </td>
                                <td>Ajouter un mode nuit pour le confort visuel</td>
                                <td>Marie Martin</td>
                                <td>28/02/2024</td>
                                <td>
                                    <span class="feedback-status in-progress">
                                        <i class="fas fa-spinner"></i>
                                        En cours
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon edit" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon resolve" title="Résoudre">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="feedback-type complaint">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Plainte
                                    </span>
                                </td>
                                <td>Problème de connexion récurrent</td>
                                <td>Pierre Durand</td>
                                <td>25/02/2024</td>
                                <td>
                                    <span class="feedback-status resolved">
                                        <i class="fas fa-check-circle"></i>
                                        Résolu
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon edit" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon resolve" title="Résoudre">
                                            <i class="fas fa-check"></i>
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

                <!-- Pagination -->
                <div class="pagination">
                    <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i></button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </main>
    </div>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/include.js"></script>
</body>
</html> 