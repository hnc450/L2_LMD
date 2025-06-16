<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles spécifiques pour la page d'accueil */
        .dashboard-stats {
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
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.13);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
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

        .stat-icon.users { background: var(--primary-color); }
        .stat-icon.quizzes { background: var(--info-color); }
        .stat-icon.questions { background: var(--success-color); }
        .stat-icon.categories { background: var(--warning-color); }

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

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.5em;
            font-size: 0.9rem;
            margin-top: 0.5em;
        }

        .stat-trend.positive {
            color: var(--success-color);
        }

        .stat-trend.negative {
            color: var(--danger-color);
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .action-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
            border: 1px solid var(--border-color);
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.13);
        }

        .action-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto var(--spacing-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            border-radius: 12px;
            background: var(--primary-color);
        }

        .action-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 0 var(--spacing-xs);
            color: var(--text-color);
        }

        .action-card p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .recent-activity {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: var(--spacing-xl);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
        }

        .activity-header h2 {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-color);
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            border-radius: var(--border-radius-md);
            background: rgba(var(--primary-rgb), 0.05);
            transition: transform var(--transition-fast);
        }

        .activity-item:hover {
            transform: translateX(5px);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .activity-icon.quiz { background: var(--primary-color); }
        .activity-icon.user { background: var(--info-color); }
        .activity-icon.category { background: var(--success-color); }
        .activity-icon.question { background: var(--warning-color); }

        .activity-info {
            flex: 1;
        }

        .activity-info h4 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-color);
        }

        .activity-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .activity-time {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .performance-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-lg);
        }

        .metric-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-md);
        }

        .metric-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-color);
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: var(--spacing-md) 0;
        }

        .metric-chart {
            height: 100px;
            background: rgba(var(--primary-rgb), 0.1);
            border-radius: var(--border-radius-md);
            margin-top: var(--spacing-md);
            position: relative;
            overflow: hidden;
        }

        .metric-chart::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(180deg, var(--primary-color), var(--primary-light));
            border-radius: 0 0 var(--border-radius-md) var(--border-radius-md);
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
                    <h1>Tableau de Bord</h1>
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
                <!-- Statistiques -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>2,345</h3>
                            <p>Utilisateurs actifs</p>
                            <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>12% ce mois</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon quizzes">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <div class="stat-info">
                            <h3>156</h3>
                            <p>Quiz créés</p>
                            <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>8% ce mois</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon questions">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1,234</h3>
                            <p>Questions</p>
                            <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>15% ce mois</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon categories">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="stat-info">
                            <h3>45</h3>
                            <p>Catégories</p>
                            <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>5% ce mois</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="quick-actions">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3>Nouveau Quiz</h3>
                        <p>Créer un nouveau quiz</p>
                    </div>

                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3>Nouvel Utilisateur</h3>
                        <p>Ajouter un utilisateur</p>
                    </div>

                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-folder-plus"></i>
                        </div>
                        <h3>Nouvelle Catégorie</h3>
                        <p>Créer une catégorie</p>
                    </div>

                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3>Paramètres</h3>
                        <p>Configurer le jeu</p>
                    </div>
                </div>

                <!-- Activité récente -->
                <div class="recent-activity">
                    <div class="activity-header">
                        <h2><i class="fas fa-history"></i> Activité Récente</h2>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon quiz">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <div class="activity-info">
                                <h4>Nouveau quiz créé</h4>
                                <p>Quiz sur l'Histoire de France</p>
                            </div>
                            <span class="activity-time">Il y a 5 min</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon user">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-info">
                                <h4>Nouvel utilisateur</h4>
                                <p>Marie Martin s'est inscrite</p>
                            </div>
                            <span class="activity-time">Il y a 15 min</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon category">
                                <i class="fas fa-folder"></i>
                            </div>
                            <div class="activity-info">
                                <h4>Nouvelle catégorie</h4>
                                <p>Catégorie "Géographie" ajoutée</p>
                            </div>
                            <span class="activity-time">Il y a 1h</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon question">
                                <i class="fas fa-question"></i>
                            </div>
                            <div class="activity-info">
                                <h4>Questions ajoutées</h4>
                                <p>50 nouvelles questions ajoutées</p>
                            </div>
                            <span class="activity-time">Il y a 2h</span>
                        </div>
                    </div>
                </div>

                <!-- Métriques de performance -->
                <div class="performance-metrics">
                    <div class="metric-card">
                        <div class="metric-header">
                            <h3>Taux de complétion</h3>
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="metric-value">85%</div>
                        <div class="metric-chart"></div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-header">
                            <h3>Temps moyen</h3>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="metric-value">4.5 min</div>
                        <div class="metric-chart"></div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-header">
                            <h3>Score moyen</h3>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="metric-value">78%</div>
                        <div class="metric-chart"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/include.js"></script>
</body>
</html> 