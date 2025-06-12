<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 30px;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .breadcrumb {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 10px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .page-subtitle {
            font-size: 16px;
            opacity: 0.9;
        }

        .main-content {
            padding: 40px;
        }

        .user-overview {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 30px;
            align-items: center;
            margin-bottom: 40px;
            padding: 30px;
            background: #f8fafc;
            border-radius: 15px;
            border-left: 5px solid #2563eb;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
        }

        .user-info h2 {
            font-size: 24px;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .user-info p {
            color: #64748b;
            margin-bottom: 3px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .detail-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .detail-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #64748b;
        }

        .info-value {
            color: #1e293b;
            font-weight: 500;
        }

        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .btn-secondary {
            background: white;
            color: #2563eb;
            border: 2px solid #2563eb;
        }

        .btn-secondary:hover {
            background: #2563eb;
            color: white;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .activity-timeline {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .timeline-item:last-child {
            border-bottom: none;
        }

        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #2563eb;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .timeline-time {
            font-size: 14px;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .user-overview {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 20px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .main-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php
        use App\Models\Database\Database;
        $user = Database::executeQuery(
            "SELECT * FROM users WHERE id_user= :id",
            ['id' => $value],
            2);
    ?>
    <?= $user[0]['nom']  ?? ''?>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <div class="breadcrumb">Administration > Utilisateurs > Profil</div>
                <h1 class="page-title">Profil Utilisateur</h1>
                <p class="page-subtitle">Gestion et détails du compte utilisateur</p>
            </div>
        </div>

        <div class="main-content">
            <div class="user-overview">
                <div class="avatar"><?=$user[0]['id_user']?></div>
                <div class="user-info">
                    <h2> <?= $user[0]['prenoms'] ?? '' ?></h2>
                    <p> <?= $user[0]['mails'] ?? '' ?></p>
                    <p>ID:#<?= $user[0]['id_user'] ?? ''?></p>
                    <p>Membre depuis le 15 janvier 2023</p>
                </div>
                <div class="status-badge status-active">Actif</div>
            </div>

            <div class="details-grid">
                <div class="detail-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 9H14V4H5V21H19V9Z"/>
                            </svg>
                        </div>
                        <h3 class="card-title">Informations Personnelles</h3>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nom complet</span>
                        <span class="info-value"> <?= $user[0]['nom'] ?? ''?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value"> <?= $user[0]['email']  ?? ''  ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Rang</span>
                        <span class="info-value"> <?= $user[0]['phone'] ?? '' ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date de naissance</span>
                        <span class="info-value">15/03/1990</span>
                    </div>
                </div>

                <div class="detail-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                <path d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.22,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.22,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.68 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"/>
                            </svg>
                        </div>
                        <h3 class="card-title">Paramètres du Compte</h3>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Statut</span>
                        <span class="info-value"> 
                            <?php if(isset($user[0]['status'])): ?>
                              <?= (int)$user[0]['status']  ? 'Online' : 'Offline'  ?>
                            <?php endif;?>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Rôle</span>
                        <span class="info-value"><?=$user[0]['role'] ??''?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Dernière connexion</span>
                        <span class="info-value">Aujourd'hui, 14:30</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Vérification email</span>
                        <span class="info-value">✅ Vérifié</span>
                    </div>
                </div>

                <div class="detail-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                <path d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5H5.21L4.27,3H1M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z"/>
                            </svg>
                        </div>
                        <h3 class="card-title">Activité</h3>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Commandes totales</span>
                        <span class="info-value">12</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Montant total</span>
                        <span class="info-value">1,245.50 €</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Dernière commande</span>
                        <span class="info-value">23/12/2024</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Points fidélité</span>
                        <span class="info-value">2,450 pts</span>
                    </div>
                </div>

                <div class="activity-timeline">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                <path d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                            </svg>
                        </div>
                        <h3 class="card-title">Activité Récente</h3>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Connexion au compte</div>
                            <div class="timeline-time">Aujourd'hui à 14:30</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Commande #CMD-5678 passée</div>
                            <div class="timeline-time">23 décembre 2024</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Profil mis à jour</div>
                            <div class="timeline-time">20 décembre 2024</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Email vérifié</div>
                            <div class="timeline-time">15 janvier 2023</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button class="btn btn-primary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                    </svg>
                    Modifier
                </button>
                <button class="btn btn-secondary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17C11.45,17 11,16.55 11,16C11,15.45 11.45,15 12,15C12.55,15 13,15.45 13,16C13,16.55 12.55,17 12,17M12,9A3,3 0 0,1 15,12C15,13 14.5,13.5 14,14C13.5,14.5 13,15 13,16H11C11,14.5 11.5,14 12,13.5C12.5,13 13,12.5 13,12A1,1 0 0,0 12,11A1,1 0 0,0 11,12H9A3,3 0 0,1 12,9Z"/>
                    </svg>
                    Assistance
                </button>
                <button class="btn btn-danger">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z"/>
                    </svg>
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</body>
</html>