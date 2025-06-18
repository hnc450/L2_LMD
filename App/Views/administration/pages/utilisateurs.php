<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Slider styles */
        .user-slider {
            margin-bottom: var(--spacing-xl);
            overflow: hidden;
            position: relative;
        }
        .slider-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(.4,2,.6,1);
            gap: var(--spacing-lg);
        }
        .slide-card {
            min-width: 260px;
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: var(--spacing-lg);
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid var(--border-color);
            transition: box-shadow var(--transition-fast), transform var(--transition-fast);
        }
        .slide-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.13);
            transform: translateY(-3px) scale(1.03);
        }
        .slide-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        .slide-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            pointer-events: none;
        }
        .slider-btn {
            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            pointer-events: all;
            transition: background var(--transition-fast);
        }
        .slider-btn:hover {
            background: var(--primary-dark);
        }
        /* Table styles */
        .users-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }
        .users-table th, .users-table td {
            padding: 1rem 0.75rem;
            text-align: left;
        }
        .users-table th {
            color: var(--primary-color);
            font-size: 1rem;
            font-weight: 700;
            background: none;
            border-bottom: 2px solid var(--border-color);
        }
        .users-table tr {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: box-shadow var(--transition-fast), transform var(--transition-fast);
        }
        .users-table tr:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.13);
            transform: translateY(-2px) scale(1.01);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }
        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
            background: #fff;
        }
        .user-name {
            font-weight: 600;
            font-size: 1.05rem;
        }
        .user-email {
            font-size: 0.95rem;
            opacity: 0.7;
        }
        .role-badge, .status-badge {
            display: inline-block;
            padding: 0.3em 0.8em;
            border-radius: 1em;
            font-size: 0.95em;
            font-weight: 600;
            color: #fff;
        }
        .role-badge.admin { background: var(--primary-color); }
        .role-badge.moderator { background: var(--info-color); }
        .role-badge.player { background: var(--success-color); }
        .status-badge.active { background: var(--success-color); }
        .status-badge.inactive { background: var(--warning-color); }
        .status-badge.banned { background: var(--danger-color); }
        .action-buttons {
            display: flex;
            gap: var(--spacing-sm);
        }
        .btn-icon {
            background: var(--primary-light);
            color: #fff;
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
        .btn-icon.ban { background: var(--warning-color); }
        .btn-icon.delete { background: var(--danger-color); }
        .btn-icon:hover {
            transform: scale(1.12);
            filter: brightness(1.1);
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
        .pagination {
            display: flex;
            justify-content: center;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-lg);
        }
        .pagination-btn {
            background: var(--primary-color);
            color: #fff;
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
                    <h1>Gestion des Utilisateurs</h1>
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
                <!-- Slider/Carrousel d'infos rapides -->
                <div class="user-slider">
                    <div class="slider-track" id="sliderTrack">
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-users"></i> Utilisateurs inscrits</div>
                            <div class="slide-value">2,345</div>
                        </div>
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-user-check"></i> Actifs ce mois</div>
                            <div class="slide-value">1,234</div>
                        </div>
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-user-plus"></i> Nouveaux cette semaine</div>
                            <div class="slide-value">56</div>
                        </div>
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-user-shield"></i> Admins</div>
                            <div class="slide-value">3</div>
                        </div>
                    </div>
                    <div class="slider-nav">
                        <button class="slider-btn" id="sliderPrev"><i class="fas fa-chevron-left"></i></button>
                        <button class="slider-btn" id="sliderNext"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Filtres et Recherche -->
                <div class="filters-section">
                    <div class="search-filter">
                        <input type="text" placeholder="Rechercher un utilisateur...">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option>Tous les rôles</option>
                            <option>Admin</option>
                            <option>Modérateur</option>
                            <option>Joueur</option>
                        </select>
                        <select class="filter-select">
                            <option>Tous les statuts</option>
                            <option>Actif</option>
                            <option>Inactif</option>
                            <option>Banni</option>
                        </select>
                    </div>
                </div>

                <!-- Liste des Utilisateurs -->
                <div class="users-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Inscription</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="img/avatar.png" alt="Avatar" class="user-avatar">
                                        <div>
                                            <p class="user-name">Jean Dupont</p>
                                            <p class="user-email">jean.dupont@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge admin">Admin</span></td>
                                <td><span class="status-badge active">Actif</span></td>
                                <td>01/01/2024</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon edit" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon ban" title="Bannir">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="img/avatar.png" alt="Avatar" class="user-avatar">
                                        <div>
                                            <p class="user-name">Marie Martin</p>
                                            <p class="user-email">marie.martin@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge moderator">Modérateur</span></td>
                                <td><span class="status-badge active">Actif</span></td>
                                <td>15/01/2024</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon edit" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon ban" title="Bannir">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="img/avatar.png" alt="Avatar" class="user-avatar">
                                        <div>
                                            <p class="user-name">Pierre Durand</p>
                                            <p class="user-email">pierre.durand@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge player">Joueur</span></td>
                                <td><span class="status-badge inactive">Inactif</span></td>
                                <td>20/01/2024</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon edit" title="Modifier">
                                            <i class="fas fa-edit" style="color: #fff;"></i>
                                        </button>
                                        <button class="btn-icon ban" title="Bannir">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Supprimer">
                                            <i class="fa-solid fa-trash" style="color: #fff;"></i>
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
    <!-- <script src="/js/admin-users.js"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('sliderTrack');
            const prev = document.getElementById('sliderPrev');
            const next = document.getElementById('sliderNext');
            let slideIndex = 0;
            const slides = document.querySelectorAll('.slide-card');
            const visibleSlides = window.innerWidth < 900 ? 1 : 3;
            function updateSlider() {
                const slideWidth = slides[0].offsetWidth + 32; // 32px = gap
                track.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
            }
            prev.onclick = () => {
                if (slideIndex > 0) {
                    slideIndex--;
                    updateSlider();
                }
            };
            next.onclick = () => {
                if (slideIndex < slides.length - visibleSlides) {
                    slideIndex++;
                    updateSlider();
                }
            };
            window.addEventListener('resize', updateSlider);
            updateSlider();
        });
    </script>
</body>
</html> 