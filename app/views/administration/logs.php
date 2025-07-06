<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles spécifiques pour la page logs */
        .logs-stats {
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

        .stat-icon.login { background: var(--primary-color); }
        .stat-icon.modification { background: var(--info-color); }
        .stat-icon.deletion { background: var(--danger-color); }
        .stat-icon.security { background: var(--warning-color); }

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

        .logs-table {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .logs-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .logs-table th {
            background: var(--primary-light);
            color: white;
            font-weight: 600;
            text-align: left;
            padding: 1rem;
        }

        .logs-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .logs-table tr:last-child td {
            border-bottom: none;
        }

        .logs-table tr:hover {
            background: rgba(var(--primary-rgb), 0.05);
        }

        .log-type {
            display: inline-flex;
            align-items: center;
            gap: 0.5em;
            padding: 0.3em 0.8em;
            border-radius: 1em;
            font-size: 0.9em;
            font-weight: 600;
            color: white;
        }

        .log-type.login { background: var(--primary-color); }
        .log-type.modification { background: var(--info-color); }
        .log-type.deletion { background: var(--danger-color); }
        .log-type.security { background: var(--warning-color); }

        .log-description {
            max-width: 400px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

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

        .btn-icon.view { background: var(--info-color); }
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
                    <h1>Logs et Historique</h1>
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
                <div class="logs-stats">
                    <div class="stat-card">
                        <div class="stat-icon login">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1,234</h3>
                            <p>Connexions</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon modification">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="stat-info">
                            <h3>567</h3>
                            <p>Modifications</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon deletion">
                            <i class="fas fa-trash"></i>
                        </div>
                        <div class="stat-info">
                            <h3>89</h3>
                            <p>Suppressions</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon security">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>45</h3>
                            <p>Alertes sécurité</p>
                        </div>
                    </div>
                </div>

                <!-- Filtres et Recherche -->
                <div class="filters-section">
                    <div class="search-filter">
                        <input type="text" placeholder="Rechercher dans les logs...">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option>Tous les types</option>
                            <option>Connexion</option>
                            <option>Modification</option>
                            <option>Suppression</option>
                            <option>Sécurité</option>
                        </select>
                        <select class="filter-select">
                            <option>Toutes les dates</option>
                            <option>Aujourd'hui</option>
                            <option>Cette semaine</option>
                            <option>Ce mois</option>
                        </select>
                    </div>
                </div>

                <!-- Liste des Logs -->
                <div class="logs-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Utilisateur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01/03/2024 14:30</td>
                                <td>
                                    <span class="log-type login">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Connexion
                                    </span>
                                </td>
                                <td class="log-description">Connexion réussie depuis l'IP 192.168.1.1</td>
                                <td>Jean Dupont</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon view" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>01/03/2024 13:45</td>
                                <td>
                                    <span class="log-type modification">
                                        <i class="fas fa-edit"></i>
                                        Modification
                                    </span>
                                </td>
                                <td class="log-description">Modification du quiz "Capitales d'Europe"</td>
                                <td>Marie Martin</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon view" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>01/03/2024 12:15</td>
                                <td>
                                    <span class="log-type security">
                                        <i class="fas fa-shield-alt"></i>
                                        Sécurité
                                    </span>
                                </td>
                                <td class="log-description">Tentative de connexion échouée (3 tentatives)</td>
                                <td>Pierre Durand</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon view" title="Voir les détails">
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
    <script src="/js/theme.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/logs.js"></script>
</body>
</html> 