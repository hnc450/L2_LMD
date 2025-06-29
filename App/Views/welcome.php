<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="welcome-page">
    <div class="welcome-container">
        <div class="welcome-slides" id="welcomeSlides">
            <!-- Slide 1 -->
            <div class="welcome-slide active">
                <div class="welcome-image">
                    <img src="img/welcome1.jpg" alt="Bienvenue">
                </div>
                <div class="welcome-text">
                    <h1>Bienvenue dans Le Monde Dans Ma Poche</h1>
                    <p>Découvrez le monde à travers des quiz interactifs et amusants</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="welcome-slide">
                <div class="welcome-image">
                    <img src="img/welcome2.jpg" alt="Apprendre">
                </div>
                <div class="welcome-text">
                    <h1>Apprenez en vous amusant</h1>
                    <p>Des modules adaptés à votre âge pour progresser à votre rythme</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="welcome-slide">
                <div class="welcome-image">
                    <img src="img/welcome3.jpg" alt="Compétition">
                </div>
                <div class="welcome-text">
                    <h1>Relevez des défis</h1>
                    <p>Gagnez des trophées et montez dans les ligues</p>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="welcome-slide">
                <div class="welcome-image">
                    <img src="img/welcome4.jpg" alt="Commencer">
                </div>
                <div class="welcome-text">
                    <h1>Prêt à commencer l'aventure?</h1>
                    <p>Rejoignez des milliers d'explorateurs du monde entier</p>
                    <div class="welcome-buttons">
                        <a href="/login" class="btn-welcome">Se connecter</a>
                        <a href="/user/home" class="btn-welcome primary">Commencer</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="welcome-controls">
            <div class="welcome-dots">
                <span class="welcome-dot active" data-slide="0"></span>
                <span class="welcome-dot" data-slide="1"></span>
                <span class="welcome-dot" data-slide="2"></span>
                <span class="welcome-dot" data-slide="3"></span>
            </div>
            <button class="welcome-next" id="welcomeNext">Suivant <i class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <script src="/js/welcome.js"></script>
    <script src="/js/script.js" defer></script>
</body>
</html>
