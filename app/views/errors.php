<?php
$message = '';
$subtitle = '';

switch($value) {
    case 401:
        $message = "non autorisé";
        $subtitle = "pour acceder a cette ressource vous devez vous authentifié";
    case 403:
        $message = "Accès interdit";
        $subtitle = "Vous n'avez pas la permission d'accéder à cette page.";
        break;
    case 404:

    default:
        $message = "Page non trouvée";
        $subtitle = "La page que vous cherchez n'existe pas ou a été déplacée.";
        break;
}
http_response_code($value);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur <?= $code ?> - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: var(--bg-dark);
            color: var(--text-color-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            background: var(--card-bg);
            border-radius: var(--border-radius-xl);
            box-shadow: 0 8px 32px rgba(138,43,226,0.15);
            padding: 3rem 2.5rem;
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .error-code {
            font-size: 5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 2rem;
            color: var(--primary-light);
            margin-bottom: 0.5rem;
        }
        .error-subtitle {
            font-size: 1.1rem;
            color: var(--text-color-light);
            opacity: 0.8;
            margin-bottom: 2rem;
        }
        .error-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .btn-home {
            display: inline-block;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            color: white;
            padding: 0.8rem 2rem;
            border-radius: var(--border-radius-lg);
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(138,43,226,0.08);
        }
        .btn-home:hover {
            background: linear-gradient(90deg, var(--primary-dark), var(--primary-color));
        }
    </style>
</head>
<body class="dark-theme">
    <div class="error-container">
        <div class="error-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div class="error-code"><?= $value ?></div>
        <div class="error-message"><?=  $message ?></div>
        <div class="error-subtitle"><?= $subtitle ?></div>
        <a href="/" class="btn-home"><i class="fas fa-home"></i> Retour à l'accueil</a>
    </div>
    <script src="/js/script.js" defer></script>
</body>
</html>
