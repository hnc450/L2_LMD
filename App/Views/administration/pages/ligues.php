<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Ligues - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles spécifiques pour la page ligues */
        .leagues-stats {
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

        .stat-icon.players { background: var(--primary-color); }
        .stat-icon.badges { background: var(--info-color); }
        .stat-icon.leagues { background: var(--success-color); }
        .stat-icon.rankings { background: var(--warning-color); }

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

        .leagues-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .league-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .league-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.13);
        }

        .league-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .league-card.bronze::before { background: linear-gradient(90deg, #cd7f32, #e6b17a); }
        .league-card.silver::before { background: linear-gradient(90deg, #c0c0c0, #e8e8e8); }
        .league-card.gold::before { background: linear-gradient(90deg, #ffd700, #ffec80); }
        .league-card.platinum::before { background: linear-gradient(90deg, #e5e4e2, #ffffff); }

        .league-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }

        .league-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .league-icon.bronze { background: #cd7f32; }
        .league-icon.silver { background: #c0c0c0; }
        .league-icon.gold { background: #ffd700; }
        .league-icon.platinum { background: #e5e4e2; }

        .league-info h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-color);
        }

        .league-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .league-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--spacing-md);
            margin-top: var(--spacing-md);
            padding-top: var(--spacing-md);
            border-top: 1px solid var(--border-color);
        }

        .league-stat {
            text-align: center;
        }

        .league-stat h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-color);
        }

        .league-stat p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .badges-section {
            margin-bottom: var(--spacing-xl);
        }

        .badges-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-lg);
        }

        .badge-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
            border: 1px solid var(--border-color);
        }

        .badge-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.13);
        }

        .badge-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto var(--spacing-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            border-radius: 50%;
            background: var(--primary-color);
        }

        .badge-icon.explorer { background: var(--info-color); }
        .badge-icon.master { background: var(--success-color); }
        .badge-icon.legend { background: var(--warning-color); }

        .badge-info h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 0 var(--spacing-xs);
            color: var(--text-color);
        }

        .badge-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .badge-count {
            display: inline-block;
            padding: 0.3em 0.8em;
            border-radius: 1em;
            background: var(--primary-light);
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: var(--spacing-sm);
        }

        .leaderboard-section {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .leaderboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
        }

        .leaderboard-header h2 {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-color);
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .leaderboard-table th {
            background: var(--primary-light);
            color: white;
            font-weight: 600;
            text-align: left;
            padding: 1rem;
        }

        .leaderboard-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .leaderboard-table tr:last-child td {
            border-bottom: none;
        }

        .leaderboard-table tr:hover {
            background: rgba(var(--primary-rgb), 0.05);
        }

        .player-rank {
            font-weight: 600;
            color: var(--primary-color);
        }

        .player-info {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }

        .player-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
        }

        .player-name {
            font-weight: 500;
        }

        .player-league {
            display: inline-flex;
            align-items: center;
            gap: 0.5em;
            padding: 0.3em 0.8em;
            border-radius: 1em;
            font-size: 0.9em;
            font-weight: 600;
            color: white;
        }

        .player-league.bronze { background: #cd7f32; }
        .player-league.silver { background: #c0c0c0; }
        .player-league.gold { background: #ffd700; }
        .player-league.platinum { background: #e5e4e2; }

        .player-points {
            font-weight: 600;
            color: var(--success-color);
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
                    <h1>Gestion des Ligues</h1>
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
                <div class="leagues-stats">
                    <div class="stat-card">
                        <div class="stat-icon players">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>2,345</h3>
                            <p>Joueurs actifs</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon badges">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-info">
                            <h3>156</h3>
                            <p>Badges débloqués</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon leagues">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-info">
                            <h3>4</h3>
                            <p>Ligues disponibles</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon rankings">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3>89</h3>
                            <p>Changements de ligue</p>
                        </div>
                    </div>
                </div>

                <!-- Ligues Section -->
                <div class="leagues-grid">
                    <div class="league-card bronze">
                        <div class="league-header">
                            <div class="league-icon bronze">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="league-info">
                                <h3>Ligue Bronze</h3>
                                <p>0 - 1000 points</p>
                            </div>
                        </div>
                        <div class="league-stats">
                            <div class="league-stat">
                                <h4>1,234</h4>
                                <p>Joueurs</p>
                            </div>
                            <div class="league-stat">
                                <h4>45%</h4>
                                <p>Progression</p>
                            </div>
                        </div>
                    </div>

                    <div class="league-card silver">
                        <div class="league-header">
                            <div class="league-icon silver">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="league-info">
                                <h3>Ligue Argent</h3>
                                <p>1000 - 2500 points</p>
                            </div>
                        </div>
                        <div class="league-stats">
                            <div class="league-stat">
                                <h4>567</h4>
                                <p>Joueurs</p>
                            </div>
                            <div class="league-stat">
                                <h4>30%</h4>
                                <p>Progression</p>
                            </div>
                        </div>
                    </div>

                    <div class="league-card gold">
                        <div class="league-header">
                            <div class="league-icon gold">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="league-info">
                                <h3>Ligue Or</h3>
                                <p>2500 - 5000 points</p>
                            </div>
                        </div>
                        <div class="league-stats">
                            <div class="league-stat">
                                <h4>234</h4>
                                <p>Joueurs</p>
                            </div>
                            <div class="league-stat">
                                <h4>20%</h4>
                                <p>Progression</p>
                            </div>
                        </div>
                    </div>

                    <div class="league-card platinum">
                        <div class="league-header">
                            <div class="league-icon platinum">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="league-info">
                                <h3>Ligue Platine</h3>
                                <p>5000+ points</p>
                            </div>
                        </div>
                        <div class="league-stats">
                            <div class="league-stat">
                                <h4>89</h4>
                                <p>Joueurs</p>
                            </div>
                            <div class="league-stat">
                                <h4>5%</h4>
                                <p>Progression</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Badges Section -->
                <div class="badges-section">
                    <h2><i class="fas fa-award"></i> Badges</h2>
                    <div class="badges-grid">
                        <div class="badge-card">
                            <div class="badge-icon explorer">
                                <i class="fas fa-compass"></i>
                            </div>
                            <div class="badge-info">
                                <h3>Explorateur</h3>
                                <p>Découvrez tous les continents</p>
                                <span class="badge-count">234 joueurs</span>
                            </div>
                        </div>

                        <div class="badge-card">
                            <div class="badge-icon master">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="badge-info">
                                <h3>Maître</h3>
                                <p>Complétez 100 quiz</p>
                                <span class="badge-count">89 joueurs</span>
                            </div>
                        </div>

                        <div class="badge-card">
                            <div class="badge-icon legend">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="badge-info">
                                <h3>Légende</h3>
                                <p>Atteignez la ligue platine</p>
                                <span class="badge-count">45 joueurs</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leaderboard Section -->
                <div class="leaderboard-section">
                    <div class="leaderboard-header">
                        <h2><i class="fas fa-trophy"></i> Classement des Joueurs</h2>
                    </div>
                    <table class="leaderboard-table">
                        <thead>
                            <tr>
                                <th>Rang</th>
                                <th>Joueur</th>
                                <th>Ligue</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="player-rank">#1</span></td>
                                <td>
                                    <div class="player-info">
                                        <img src="img/avatar.png" alt="Avatar" class="player-avatar">
                                        <span class="player-name">Jean Dupont</span>
                                    </div>
                                </td>
                                <td><span class="player-league platinum">Platine</span></td>
                                <td><span class="player-points">7,890</span></td>
                            </tr>
                            <tr>
                                <td><span class="player-rank">#2</span></td>
                                <td>
                                    <div class="player-info">
                                        <img src="img/avatar.png" alt="Avatar" class="player-avatar">
                                        <span class="player-name">Marie Martin</span>
                                    </div>
                                </td>
                                <td><span class="player-league gold">Or</span></td>
                                <td><span class="player-points">6,543</span></td>
                            </tr>
                            <tr>
                                <td><span class="player-rank">#3</span></td>
                                <td>
                                    <div class="player-info">
                                        <img src="img/avatar.png" alt="Avatar" class="player-avatar">
                                        <span class="player-name">Pierre Durand</span>
                                    </div>
                                </td>
                                <td><span class="player-league gold">Or</span></td>
                                <td><span class="player-points">5,678</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="/js/theme.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/script.js" defer></script>
</body>
</html> 