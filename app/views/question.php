<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Amusant - Pour Tous les Âges!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: linear-gradient(135deg, #6a0dad, #4b0082, #2e0054);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            overflow-x: hidden;
        }

        .container {
            max-width: 800px;
            width: 90%;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(106, 13, 173, 0.3);
            border: 3px solid #8a2be2;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(138, 43, 226, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-size: 3em;
            color: #da70d6;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .subtitle {
            font-size: 1.2em;
            color: #dda0dd;
            margin-bottom: 20px;
        }

        .start-screen, .quiz-screen, .result-screen {
            display: none;
            text-align: center;
        }

        .start-screen.active, .quiz-screen.active, .result-screen.active {
            display: block;
        }

        .start-btn, .next-btn, .restart-btn {
            background: linear-gradient(45deg, #8a2be2, #da70d6);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(138, 43, 226, 0.4);
            font-family: inherit;
            margin: 10px;
        }

        .start-btn:hover, .next-btn:hover, .restart-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(138, 43, 226, 0.6);
            background: linear-gradient(45deg, #9932cc, #ee82ee);
        }

        .question-container {
            background: rgba(138, 43, 226, 0.2);
            border-radius: 15px;
            padding: 25px;
            margin: 20px 0;
            border: 2px solid #8a2be2;
        }

        .question {
            font-size: 1.4em;
            margin-bottom: 20px;
            color: #f0e6ff;
            line-height: 1.4;
        }

        .question-number {
            background: #8a2be2;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            margin-bottom: 15px;
            display: inline-block;
        }

        .options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .option {
            background: rgba(0, 0, 0, 0.6);
            border: 2px solid #8a2be2;
            color: white;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1em;
            text-align: center;
        }

        .option:hover {
            background: rgba(138, 43, 226, 0.3);
            transform: scale(1.05);
            border-color: #da70d6;
        }

        .option.selected {
            background: linear-gradient(45deg, #8a2be2, #da70d6);
            border-color: #ee82ee;
            transform: scale(1.05);
        }

        .option.correct {
            background: linear-gradient(45deg, #32cd32, #90ee90);
            border-color: #00ff00;
            animation: pulse 0.5s ease-in-out;
        }

        .option.incorrect {
            background: linear-gradient(45deg, #dc143c, #ff6b6b);
            border-color: #ff0000;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .progress-bar {
            background: rgba(0, 0, 0, 0.5);
            height: 10px;
            border-radius: 5px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress {
            background: linear-gradient(90deg, #8a2be2, #da70d6);
            height: 100%;
            border-radius: 5px;
            transition: width 0.5s ease;
            box-shadow: 0 0 10px rgba(138, 43, 226, 0.5);
        }

        .score-display {
            font-size: 1.2em;
            margin: 15px 0;
            color: #dda0dd;
        }

        .result-message {
            font-size: 2em;
            margin: 20px 0;
            color: #da70d6;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .final-score {
            font-size: 3em;
            color: #ee82ee;
            margin: 20px 0;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
        }

        .emoji {
            font-size: 2em;
            margin: 0 10px;
            animation: wiggle 1s ease-in-out infinite;
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
        }

        .fun-facts {
            background: rgba(138, 43, 226, 0.2);
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #8a2be2;
        }

        @media (max-width: 600px) {
            .title {
                font-size: 2em;
            }
            
            .options {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 20px;
            }
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -2;
        }

        .shape {
            position: absolute;
            background: rgba(138, 43, 226, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="header">
            <h1 class="title">🎯 Quiz Amusant 🎯</h1>
            <p class="subtitle">Pour tous les âges - Enfants, Ados & Adultes!</p>
        </div>

        <!-- Écran de démarrage -->
        <div class="start-screen active">
            <div class="fun-facts">
                <h3>🌟 Prêt pour le défi ? 🌟</h3>
                <p>10 questions amusantes t'attendent ! Des questions de culture générale, de logique et de fun pour tous les âges.</p>
                <p><span class="emoji">🧠</span> Teste tes connaissances <span class="emoji">🎉</span></p>
            </div>
            <button class="start-btn" onclick="startQuiz()">🚀 Commencer le Quiz 🚀</button>
        </div>

        <!-- Écran du quiz -->
        <div class="quiz-screen">
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>
            <div class="score-display">
                Score: <span id="current-score">0</span>/10 <span class="emoji">⭐</span>
            </div>
            
            <div class="question-container">
                <div class="question-number" id="question-number">Question 1/10</div>
                <div class="question" id="question-text"></div>
                <div class="options" id="options"></div>
            </div>
            
            <button class="next-btn" id="next-btn" onclick="nextQuestion()" style="display: none;">
                Question Suivante 🎯
            </button>
        </div>

        <!-- Écran des résultats -->
        <div class="result-screen">
            <div class="result-message" id="result-message"></div>
            <div class="final-score" id="final-score"></div>
            <div class="fun-facts" id="result-details"></div>
            <button class="restart-btn" onclick="restartQuiz()">🔄 Rejouer 🔄</button>
        </div>
    </div>

    <script>
        const questions = [
            {
                question: "🐱 Quel est le plus gros chat sauvage du monde ?",
                options: ["Le lion", "Le tigre", "Le léopard", "Le guépard"],
                correct: 1,
                explanation: "Le tigre peut peser jusqu'à 300 kg !"
            },
            {
                question: "🌈 Combien de couleurs y a-t-il dans un arc-en-ciel ?",
                options: ["5", "6", "7", "8"],
                correct: 2,
                explanation: "Rouge, Orange, Jaune, Vert, Bleu, Indigo, Violet !"
            },
            {
                question: "🧮 Combien font 15 + 27 ?",
                options: ["40", "41", "42", "43"],
                correct: 2,
                explanation: "15 + 27 = 42, comme la réponse à tout dans l'univers !"
            },
            {
                question: "🌍 Quel est le plus petit pays du monde ?",
                options: ["Monaco", "Vatican", "Liechtenstein", "Andorre"],
                correct: 1,
                explanation: "Le Vatican fait seulement 0,44 km² !"
            },
            {
                question: "🦕 À quelle époque ont vécu les dinosaures ?",
                options: ["Jurassique", "Crétacé", "Trias", "Toutes ces réponses"],
                correct: 3,
                explanation: "Les dinosaures ont vécu pendant ces trois périodes !"
            },
            {
                question: "🎵 Combien de cordes a une guitare classique ?",
                options: ["4", "5", "6", "7"],
                correct: 2,
                explanation: "Une guitare classique a 6 cordes !"
            },
            {
                question: "🍕 Dans quel pays a été inventée la pizza ?",
                options: ["France", "Italie", "Grèce", "Espagne"],
                correct: 1,
                explanation: "La pizza moderne vient de Naples, en Italie !"
            },
            {
                question: "🌙 Combien de temps faut-il à la Lune pour tourner autour de la Terre ?",
                options: ["24 heures", "7 jours", "28 jours", "365 jours"],
                correct: 2,
                explanation: "La Lune fait le tour de la Terre en environ 28 jours !"
            },
            {
                question: "🎨 Qui a peint la Joconde ?",
                options: ["Picasso", "Van Gogh", "Léonard de Vinci", "Monet"],
                correct: 2,
                explanation: "Léonard de Vinci a peint ce chef-d'œuvre vers 1503 !"
            },
            {
                question: "🐧 Où vivent les manchots empereurs ?",
                options: ["Arctique", "Antarctique", "Groenland", "Alaska"],
                correct: 1,
                explanation: "Les manchots empereurs vivent en Antarctique, au pôle Sud !"
            }
        ];

        let currentQuestion = 0;
        let score = 0;
        let selectedAnswer = null;

        function startQuiz() {
            document.querySelector('.start-screen').classList.remove('active');
            document.querySelector('.quiz-screen').classList.add('active');
            showQuestion();
        }

        function showQuestion() {
            const question = questions[currentQuestion];
            document.getElementById('question-number').textContent = `Question ${currentQuestion + 1}/10`;
            document.getElementById('question-text').textContent = question.question;
            
            const optionsContainer = document.getElementById('options');
            optionsContainer.innerHTML = '';
            
            question.options.forEach((option, index) => {
                const optionElement = document.createElement('div');
                optionElement.className = 'option';
                optionElement.textContent = option;
                optionElement.onclick = () => selectAnswer(index);
                optionsContainer.appendChild(optionElement);
            });
            
            updateProgress();
            selectedAnswer = null;
            document.getElementById('next-btn').style.display = 'none';
        }

        function selectAnswer(index) {
            if (selectedAnswer !== null) return;
            
            selectedAnswer = index;
            const options = document.querySelectorAll('.option');
            const question = questions[currentQuestion];
            
            options.forEach((option, i) => {
                if (i === question.correct) {
                    option.classList.add('correct');
                } else if (i === index && i !== question.correct) {
                    option.classList.add('incorrect');
                }
                option.style.pointerEvents = 'none';
            });
            
            if (index === question.correct) {
                score++;
                document.getElementById('current-score').textContent = score;
            }
            
            setTimeout(() => {
                document.getElementById('next-btn').style.display = 'block';
            }, 1000);
        }

        function nextQuestion() {
            currentQuestion++;
            if (currentQuestion < questions.length) {
                showQuestion();
            } else {
                showResults();
            }
        }

        function updateProgress() {
            const progress = ((currentQuestion + 1) / questions.length) * 100;
            document.getElementById('progress').style.width = progress + '%';
        }

        function showResults() {
            document.querySelector('.quiz-screen').classList.remove('active');
            document.querySelector('.result-screen').classList.add('active');
            
            const percentage = (score / questions.length) * 100;
            let message, emoji;
            
            if (percentage >= 90) {
                message = "🏆 INCROYABLE ! 🏆";
                emoji = "🎉🌟🎊";
            } else if (percentage >= 70) {
                message = "🎯 EXCELLENT ! 🎯";
                emoji = "👏🎈🎁";
            } else if (percentage >= 50) {
                message = "👍 BIEN JOUÉ ! 👍";
                emoji = "😊🌈⭐";
            } else {
                message = "💪 CONTINUE ! 💪";
                emoji = "🌱🎯💫";
            }
            
            document.getElementById('result-message').textContent = message;
            document.getElementById('final-score').innerHTML = `${score}/10 ${emoji}`;
            
            let details = `<h3>🎊 Résultat Final 🎊</h3>`;
            details += `<p>Tu as obtenu <strong>${score} bonnes réponses</strong> sur 10 questions !</p>`;
            details += `<p>Pourcentage de réussite : <strong>${percentage.toFixed(0)}%</strong></p>`;
            
            if (percentage === 100) {
                details += `<p>🏅 <strong>PARFAIT !</strong> Tu es un vrai génie ! 🧠✨</p>`;
            } else if (percentage >= 80) {
                details += `<p>🌟 <strong>FANTASTIQUE !</strong> Tu as d'excellentes connaissances ! 📚</p>`;
            } else if (percentage >= 60) {
                details += `<p>👏 <strong>BRAVO !</strong> C'est un bon score ! Continue comme ça ! 🚀</p>`;
            } else {
                details += `<p>💪 <strong>COURAGE !</strong> Chaque quiz est une occasion d'apprendre ! 🌱</p>`;
            }
            
            document.getElementById('result-details').innerHTML = details;
        }

        function restartQuiz() {
            currentQuestion = 0;
            score = 0;
            selectedAnswer = null;
            document.getElementById('current-score').textContent = '0';
            document.querySelector('.result-screen').classList.remove('active');
            document.querySelector('.start-screen').classList.add('active');
        }

        // Animation des formes flottantes
        function createFloatingShapes() {
            const shapes = document.querySelectorAll('.shape');
            shapes.forEach(shape => {
                const randomDelay = Math.random() * 2;
                const randomDuration = 4 + Math.random() * 4;
                shape.style.animationDelay = randomDelay + 's';
                shape.style.animationDuration = randomDuration + 's';
            });
        }

        // Initialisation
        window.onload = function() {
            createFloatingShapes();
        };
    </script>
</body>
</html>