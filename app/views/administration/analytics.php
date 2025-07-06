<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/analytics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h1>Analytics</h1>
                </div>

                <div class="header-meduim">
                    <a href="#">acceuil</a>
                    <a href="#">parametres</a>
                    <a href="#">plaintes</a>
                    <a href="#">ligues</a>
                    <a href="#">utilisateurs</a>
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
                    <h2><i class="fas fa-chart-line"></i> Analytics & Statistiques</h2>
                    <p>Analysez les performances et l'engagement des utilisateurs</p>
                </div>

                <!-- Time Range Selector -->
                <div class="time-range-selector">
                    <button class="time-btn active" data-range="7d">7 jours</button>
                    <button class="time-btn" data-range="30d">30 jours</button>
                    <button class="time-btn" data-range="90d">3 mois</button>
                    <button class="time-btn" data-range="1y">1 an</button>
                </div>

                <!-- Key Metrics -->
                <div class="metrics-grid">
                    <div class="metric-card">
                        <div class="metric-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Utilisateurs Actifs</h3>
                            <p class="metric-value">12,456</p>
                            <span class="metric-change positive">
                                <i class="fas fa-arrow-up"></i> +15.3%
                            </span>
                        </div>
                        <div class="metric-chart">
                            <canvas id="usersChart" width="100" height="40"></canvas>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon sessions">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Sessions de Jeu</h3>
                            <p class="metric-value">45,789</p>
                            <span class="metric-change positive">
                                <i class="fas fa-arrow-up"></i> +8.7%
                            </span>
                        </div>
                        <div class="metric-chart">
                            <canvas id="sessionsChart" width="100" height="40"></canvas>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon engagement">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Temps Moyen</h3>
                            <p class="metric-value">24m 32s</p>
                            <span class="metric-change positive">
                                <i class="fas fa-arrow-up"></i> +12.1%
                            </span>
                        </div>
                        <div class="metric-chart">
                            <canvas id="engagementChart" width="100" height="40"></canvas>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon completion">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Taux de Réussite</h3>
                            <p class="metric-value">78.5%</p>
                            <span class="metric-change negative">
                                <i class="fas fa-arrow-down"></i> -2.3%
                            </span>
                        </div>
                        <div class="metric-chart">
                            <canvas id="completionChart" width="100" height="40"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-section">
                    <div class="chart-row">
                        <div class="chart-container large">
                            <div class="chart-header">
                                <h3>Évolution des Utilisateurs</h3>
                                <div class="chart-controls">
                                    <select class="chart-select">
                                        <option>Utilisateurs actifs</option>
                                        <option>Nouveaux utilisateurs</option>
                                        <option>Utilisateurs récurrents</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-content">
                                <canvas id="userEvolutionChart"></canvas>
                            </div>
                        </div>

                        <div class="chart-container medium">
                            <div class="chart-header">
                                <h3>Répartition par Âge</h3>
                            </div>
                            <div class="chart-content">
                                <canvas id="ageDistributionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="chart-row">
                        <div class="chart-container medium">
                            <div class="chart-header">
                                <h3>Catégories Populaires</h3>
                            </div>
                            <div class="chart-content">
                                <canvas id="categoriesChart"></canvas>
                            </div>
                        </div>

                        <div class="chart-container medium">
                            <div class="chart-header">
                                <h3>Performance par Heure</h3>
                            </div>
                            <div class="chart-content">
                                <canvas id="hourlyChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Content Section -->
                <div class="top-content-section">
                    <div class="section-header">
                        <h3>Contenu le Plus Populaire</h3>
                        <div class="section-controls">
                            <select class="filter-select">
                                <option>Cette semaine</option>
                                <option>Ce mois</option>
                                <option>Cette année</option>
                            </select>
                        </div>
                    </div>

                    <div class="top-content-grid">
                        <div class="top-content-card">
                            <div class="content-rank">1</div>
                            <img src="img/geography.jpg" alt="Quiz" class="content-image">
                            <div class="content-info">
                                <h4>Capitales d'Europe</h4>
                                <p>Quiz Géographie</p>
                                <div class="content-stats">
                                    <span><i class="fas fa-play"></i> 2,456 parties</span>
                                    <span><i class="fas fa-star"></i> 4.8/5</span>
                                </div>
                            </div>
                            <div class="content-trend positive">
                                <i class="fas fa-arrow-up"></i> +23%
                            </div>
                        </div>

                        <div class="top-content-card">
                            <div class="content-rank">2</div>
                            <img src="img/history.jpg" alt="Quiz" class="content-image">
                            <div class="content-info">
                                <h4>Rois de France</h4>
                                <p>Quiz Histoire</p>
                                <div class="content-stats">
                                    <span><i class="fas fa-play"></i> 1,987 parties</span>
                                    <span><i class="fas fa-star"></i> 4.6/5</span>
                                </div>
                            </div>
                            <div class="content-trend positive">
                                <i class="fas fa-arrow-up"></i> +18%
                            </div>
                        </div>

                        <div class="top-content-card">
                            <div class="content-rank">3</div>
                            <img src="img/science.jpg" alt="Quiz" class="content-image">
                            <div class="content-info">
                                <h4>Système Solaire</h4>
                                <p>Quiz Sciences</p>
                                <div class="content-stats">
                                    <span><i class="fas fa-play"></i> 1,654 parties</span>
                                    <span><i class="fas fa-star"></i> 4.9/5</span>
                                </div>
                            </div>
                            <div class="content-trend negative">
                                <i class="fas fa-arrow-down"></i> -5%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Engagement Table -->
                <div class="engagement-table-section">
                    <div class="section-header">
                        <h3>Engagement par Région</h3>
                    </div>
                    <div class="table-container">
                        <table class="analytics-table">
                            <thead>
                                <tr>
                                    <th>Région</th>
                                    <th>Utilisateurs</th>
                                    <th>Sessions</th>
                                    <th>Temps Moyen</th>
                                    <th>Taux de Réussite</th>
                                    <th>Évolution</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="region-info">
                                            <i class="fas fa-flag"></i>
                                            <span>France</span>
                                        </div>
                                    </td>
                                    <td>8,456</td>
                                    <td>32,145</td>
                                    <td>26m 15s</td>
                                    <td>82.3%</td>
                                    <td><span class="trend positive">+15.2%</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="region-info">
                                            <i class="fas fa-flag"></i>
                                            <span>Belgique</span>
                                        </div>
                                    </td>
                                    <td>2,134</td>
                                    <td>8,567</td>
                                    <td>23m 42s</td>
                                    <td>79.1%</td>
                                    <td><span class="trend positive">+8.7%</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="region-info">
                                            <i class="fas fa-flag"></i>
                                            <span>Suisse</span>
                                        </div>
                                    </td>
                                    <td>1,567</td>
                                    <td>5,234</td>
                                    <td>28m 03s</td>
                                    <td>85.7%</td>
                                    <td><span class="trend positive">+12.4%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="include.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/analytics.js"></script>
 
</body>
</html>
