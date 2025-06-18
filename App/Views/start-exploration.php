<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Monde dans ma Poche - Explorateur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="title">
                <span class="world-icon">🌍</span>
                Le Monde dans ma Poche
            </h1>
            <p class="subtitle">Explore les merveilles de notre planète !</p>
        </header>

        <div class="exploration-zone">
            <div class="country-selector">
                <h2>Choisis ta destination</h2>
                <div class="countries-grid">
                    <div class="country-card" data-country="france">
                        <div class="flag">🇫🇷</div>
                        <h3>France</h3>
                    </div>
                    <div class="country-card" data-country="japan">
                        <div class="flag">🇯🇵</div>
                        <h3>Japon</h3>
                    </div>
                    <div class="country-card" data-country="egypt">
                        <div class="flag">🇪🇬</div>
                        <h3>Égypte</h3>
                    </div>
                    <div class="country-card" data-country="brazil">
                        <div class="flag">🇧🇷</div>
                        <h3>Brésil</h3>
                    </div>
                    <div class="country-card" data-country="australia">
                        <div class="flag">🇦🇺</div>
                        <h3>Australie</h3>
                    </div>
                    <div class="country-card" data-country="canada">
                        <div class="flag">🇨🇦</div>
                        <h3>Canada</h3>
                    </div>
                </div>
            </div>

            <div class="country-info" id="countryInfo">
                <div class="info-placeholder">
                    <div class="compass">🧭</div>
                    <p>Clique sur un pays pour commencer ton exploration !</p>
                </div>
            </div>
        </div>

        <div class="fun-facts">
            <h2>Le savais-tu ?</h2>
            <div class="fact-carousel">
                <div class="fact active">
                    <span class="fact-icon">🌊</span>
                    <p>Il y a plus d'eau dans l'océan Pacifique que dans tous les autres océans réunis !</p>
                </div>
                <div class="fact">
                    <span class="fact-icon">🏔️</span>
                    <p>L'Everest grandit de 4 millimètres chaque année à cause du mouvement des plaques tectoniques !</p>
                </div>
                <div class="fact">
                    <span class="fact-icon">🌍</span>
                    <p>Il existe plus de 7000 langues parlées dans le monde aujourd'hui !</p>
                </div>
            </div>
            <div class="carousel-dots">
                <span class="dot active" data-slide="0"></span>
                <span class="dot" data-slide="1"></span>
                <span class="dot" data-slide="2"></span>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>