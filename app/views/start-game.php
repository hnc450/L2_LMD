<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démarrer le Jeu - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body.dark-theme {
            background: linear-gradient(135deg, #181828 0%, #3a256a 100%);
            min-height: 100vh;
        }
        .game-start-container {
            max-width: 600px;
            margin: 40px auto;
            background: rgba(40, 30, 60, 0.92);
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(60,30,120,0.18);
            padding: 38px 28px;
            text-align: center;
            backdrop-filter: blur(2px);
        }
        .game-category {
            display: inline-block;
            padding: 10px 22px;
            border-radius: 22px;
            background: linear-gradient(90deg, #6a4cff, #a084ee);
            color: #fff;
            font-weight: 700;
            margin-bottom: 18px;
            font-size: 16px;
            letter-spacing: 1px;
            box-shadow: 0 2px 8px rgba(106,76,255,0.10);
        }
        .game-age {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 16px;
            background: linear-gradient(90deg, #a084ee, #6a4cff);
            color: #fff;
            font-size: 14px;
            margin-bottom: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 2px 8px rgba(160,132,238,0.10);
        }
        .game-title {
            font-size: 2.2rem;
            color: #e6e0ff;
            margin-bottom: 12px;
            text-shadow: 0 2px 8px rgba(90,60,180,0.10);
        }
        .game-description {
            color: #bdb6d6;
            margin-bottom: 28px;
            font-size: 1.15rem;
        }
        .game-illustration {
            width: 200px;
            margin: 0 auto 28px auto;
            display: block;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(106,76,255,0.13);
            border: 3px solid #6a4cff;
        }
        .start-btn {
            background: linear-gradient(90deg, #6a4cff, #a084ee);
            color: #fff;
            border: none;
            border-radius: 32px;
            padding: 18px 44px;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 18px rgba(106,76,255,0.13);
            transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
            margin-bottom: 10px;
        }
        .start-btn:hover {
            background: linear-gradient(90deg, #a084ee, #6a4cff);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 32px rgba(160,132,238,0.13);
        }
        .fun-anim {
            margin-top: 30px;
            font-size: 2.5rem;
            animation: bounce 1.2s infinite alternate;
        }
        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-18px); }
        }
        /* Inputs améliorés */
        input[type="text"] {
            padding: 14px 18px;
            border-radius: 14px;
            border: 2px solid #6a4cff;
            font-size: 1.1rem;
            outline: none;
            margin: 18px 0 10px 0;
            background: rgba(60,30,80,0.18);
            color: #e6e0ff;
            box-shadow: 0 2px 8px rgba(106,76,255,0.08);
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        input[type="text"]:focus {
            border-color: #a084ee;
            background: #2a1e40;
            color: #fff;
            box-shadow: 0 4px 18px rgba(160,132,238,0.13);
        }
        /* Pour les boutons de quiz à choix */
        .quiz-choice-btn {
            background: linear-gradient(90deg, #6a4cff, #a084ee);
            color: #fff;
            border: none;
            border-radius: 22px;
            padding: 12px 32px;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 8px 0;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(106,76,255,0.08);
            transition: background 0.2s, transform 0.2s;
        }
        .quiz-choice-btn:hover {
            background: linear-gradient(90deg, #a084ee, #6a4cff);
            transform: scale(1.04);
        }
        @media (max-width: 600px) {
            .game-start-container { padding: 18px 6px; }
            .game-title { font-size: 1.3rem; }
            .start-btn { font-size: 1rem; padding: 12px 24px; }
            .game-illustration { width: 120px; }
        }
    </style>
</head>
<body>
    <div class="game-start-container">
        <div class="game-category" id="gameCategory">Catégorie : Géographie</div>
        <div class="game-age" id="gameAge">Tranche d'âge : 9-11 ans</div>
        <h1 class="game-title" id="gameTitle">Quiz Géographie : Europe</h1>
        <img src="/img/game1.jpg" alt="Illustration du jeu" class="game-illustration" id="gameImage">
        <p class="game-description" id="gameDescription">
            Découvre les pays et capitales d'Europe dans ce quiz amusant et interactif !
        </p>
        <button class="start-btn" id="startGameBtn">
            <i class="fas fa-play"></i> Commencer le jeu
        </button>

        
        <div class="fun-anim">🎲</div>
    </div>
    <script src="/js/script.js" defer></script>
    <script>
        // Récupération des paramètres
        const params = new URLSearchParams(window.location.search);
        const category = params.get('categorie') || 'Géographie';
        const age = params.get('age') || '12-14 ans';
        const title = params.get('titre') || 'Quiz Géographie : Europe';
        const desc = params.get('desc') || "Découvre les pays et capitales d'Europe dans ce quiz amusant et interactif !";
        const img = params.get('img') || '/img/game1.jpg';

        document.getElementById('gameCategory').textContent = 'Catégorie : ' + category;
        document.getElementById('gameAge').textContent = "Tranche d'âge : " + age;
        document.getElementById('gameTitle').textContent = title;
        document.getElementById('gameDescription').textContent = desc;
        document.getElementById('gameImage').src = img;

        // Fonctions d'UI pour chaque tranche d'âge
        function showGameForAge(age) {
            const container = document.querySelector('.game-start-container');
            if (age === '6-8 ans') {
                container.innerHTML = `

                `;
            } else if (age === '9-11 ans') {
                container.innerHTML = `
                    <h2 style=\"color:#6a4cff;\">Quiz à choix</h2>
                    <p style=\"color:#e6e0ff;\">Quelle est la capitale de la France ?</p>
                    <div style=\"margin:20px 0;\">
                        <button class=\"quiz-choice-btn\" onclick=\"alert('Bravo !')\">Paris</button><br>
                        <button class=\"quiz-choice-btn\" style=\"background:linear-gradient(90deg,#2a1e40,#a084ee);color:#bdb6d6;\" onclick=\"alert('Non, essaie encore !')\">Lyon</button><br>
                        <button class=\"quiz-choice-btn\" style=\"background:linear-gradient(90deg,#2a1e40,#6a4cff);color:#bdb6d6;\" onclick=\"alert('Non, essaie encore !')\">Marseille</button>
                    </div>
                    <button onclick=\"window.location.reload()\" class=\"start-btn\" style=\"margin-top:30px\"><i class='fas fa-arrow-left'></i> Retour</button>
                `;
            } else if (age === '12-14 ans') {
                container.innerHTML = `
                    <h2 style=\"color:#a084ee;\">Quiz rapide</h2>
                    <p style=\"color:#e6e0ff;\">Complète : La Terre tourne autour du ... ?</p>
                    <input type=\"text\" id=\"reponse\" placeholder=\"Ta réponse\" autofocus>
                    <button class=\"start-btn\" style=\"margin-left:10px;\" onclick=\"if(document.getElementById('reponse').value.trim().toLowerCase() === 'soleil'){alert('Bonne réponse ! ☀️')}else{alert('Essaie encore !')} \">Valider</button>
                    <br><button onclick=\"window.location.reload()\" class=\"start-btn\" style=\"margin-top:30px\"><i class='fas fa-arrow-left'></i> Retour</button>
                `;
            } else {
                container.innerHTML = `
                    <h2 style=\"color:#6a4cff;\">Quiz expert</h2>
                    <p style=\"color:#e6e0ff;\">Quel est l'élément chimique de numéro atomique 8 ?</p>
                    <input type=\"text\" id=\"reponse\" placeholder=\"Ta réponse\" autofocus>
                    <button class=\"start-btn\" style=\"margin-left:10px;\" onclick=\"if(document.getElementById('reponse').value.trim().toLowerCase() === 'oxygène' || document.getElementById('reponse').value.trim().toLowerCase() === 'oxygene'){alert('Bonne réponse ! O₂')}else{alert('Essaie encore !')} \">Valider</button>
                    <br><button onclick=\"window.location.reload()\" class=\"start-btn\" style=\"margin-top:30px\"><i class='fas fa-arrow-left'></i> Retour</button>
                `;
            }
        }

        // Action sur le bouton démarrer
        document.getElementById('startGameBtn').addEventListener('click', function() {
            showGameForAge(age);
        });

        fetch('http://localhost:8000/api/jeu/<?php echo $value?>',{ method: 'GET' })
            .then(response => response.json())
            .then(data => {
                 console.log('Données du jeu récupérées:', data);
                
            })
            .catch(error => console.error('Erreur lors de la récupération des données du jeu:', error));
    </script>
</body>
</html> 