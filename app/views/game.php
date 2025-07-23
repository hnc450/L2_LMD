<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Slides</title>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Segoe UI', Roboto, Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f8f9fa;
      padding: 20px;
      background: linear-gradient(135deg, #181828 0%, #3a256a 100%);
    }
    
    .quiz-container {
      width: 100%;
      max-width: 550px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      overflow: hidden;
    }
    
    .quiz-header {
      background: linear-gradient(135deg, #181828 0%, #3a256a 100%);
      color: white;
      padding: 20px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .quiz-title {
      font-size: 18px;
      font-weight: 600;
    }
    
    .timer {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 50px;
      padding: 8px 15px;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .timer-icon {
      width: 16px;
      height: 16px;
      border: 2px solid white;
      border-radius: 50%;
      position: relative;
    }
    
    .timer-icon::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 6px;
      height: 2px;
      background-color: white;
      transform-origin: left;
      transform: translateY(-50%) rotate(45deg);
    }
    
    .quiz-content {
      padding: 30px 25px;
    }
    
    .question-number {
      color: #3a256a;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .question {
      font-size: 20px;
      font-weight: 600;
      color: #333;
      margin-bottom: 25px;
      line-height: 1.4;
    }
    
    .choices {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    
    .choice {
      position: relative;
    }
    
    .choice input[type="radio"] {
      display: none;
    }
    
    .choice label {
      display: block;
      padding: 16px 20px;
      border: 2px solid #e9ecef;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 16px;
      position: relative;
      padding-left: 50px;
    }
    
    .choice label::before {
      content: '';
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      border: 2px solid #ced4da;
      border-radius: 50%;
      transition: all 0.2s ease;
    }
    
    .choice input[type="radio"]:checked + label::before {
      border-color: #0d6efd;
      background-color: #0d6efd;
      box-shadow: inset 0 0 0 4px white;
    }
    
    .choice label:hover {
      border-color: #0d6efd;
      background-color: rgba(13, 110, 253, 0.05);
    }
    
    .choice input[type="radio"]:checked + label {
      border-color: #0d6efd;
      background-color: rgba(13, 110, 253, 0.1);
    }
    
    .quiz-footer {
      padding: 20px 25px;
      border-top: 1px solid #e9ecef;
      display: flex;
      justify-content: space-between;
    }
    
    .question-progress {
      color: #6c757d;
      font-size: 14px;
    }
    
    .button {
      background: linear-gradient(135deg, #181828 0%, #3a256a 100%);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    
    .button:hover {
      background-color: #0b5ed7;
    }
    
    .button:disabled {
      background-color: #6c757d;
      cursor: not-allowed;
      opacity: 0.7;
    }
    
    .button-secondary {
      background-color: #6c757d;
    }
    
    .button-secondary:hover {
      background-color: #5a6268;
    }
    
    .slide {
      display: none;
    }
    
    .slide.active {
      display: block;
    }
    
    @media (max-width: 580px) {
      .quiz-container {
        border-radius: 8px;
      }
      
      .quiz-header {
        padding: 15px 20px;
      }
      
      .quiz-content {
        padding: 20px;
      }
      
      .question {
        font-size: 18px;
        margin-bottom: 20px;
      }
      
      .choice label {
        padding: 14px 15px 14px 45px;
        font-size: 15px;
      }
      
      .choice label::before {
        left: 15px;
        width: 18px;
        height: 18px;
      }
      
      .quiz-footer {
        padding: 15px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="quiz-container" id="quiz-container">
    <div class="quiz-header">
      <div class="quiz-title" id="quiz-title">General Knowledge Quiz</div>
      <div class="timer">
        <div class="timer-icon"></div>
        <span id="timer-display">02:30</span>
      </div>
    </div>
    
    <div class="quiz-content" id="quiz-content">
    
    <?php foreach($valeur['jeu'] as $value):  ?>
     <form action="/jeu/get/points/<?= $value['id_question']?>" method="get">
      <div class="slide" id="slide-<?= $value['id_question']?>">
        <div class="question-number">Question <?= $value['id_question']?></div>
        <div class="question"><?= $value['questions']?></div>
        
        <div class="choices" >
          <div class="choice">
            <input type="radio" id="q<?= $value['id_question']?>-choice1" name="q<?= $value['id_question']?>-answer"  value="<?= $value['answer_1']?><">
            <label for="q<?= $value['id_question']?>-choice1"><?= $value['answer_1']?></label>
          </div>
          
          <div class="choice">
            <input type="radio" id="q<?= $value['id_question']?>-choice2" name="q<?= $value['id_question']?>-answer" value="<?= $value['answer_1']?><">
            <label for="q<?= $value['id_question']?>-choice2"><?= $value['answer_2']?></label>
          </div>
          
          <div class="choice">
            <input type="radio" id="q<?= $value['id_question']?>-choice3" name="q<?= $value['id_question']?>-answer"value="<?= $value['answer_1']?><">
            <label for="q<?= $value['id_question']?>-choice3"><?= $value['answer_3']?></label>
          </div>
        </div>
      </div>
      </form>
      <?php endforeach; ?>
    </div>
    
    <div class="quiz-footer">
      <div class="question-progress" id="question-progress">1 of 2</div>
      <div class="buttons-container">
        <button class="button button-secondary" id="prev-button">Previous</button>
        <button class="button" id="next-button">Next Question</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Variables
      let currentSlideIndex = 0;
      const slides = document.querySelectorAll('.slide');
      const totalSlides = slides.length;
      const prevButton = document.getElementById('prev-button');
      const nextButton = document.getElementById('next-button');
      const questionProgress = document.getElementById('question-progress');

      const timerMinutes = <?= isset($valeur['jeu'][0]['duration']) ? (int)$valeur['jeu'][0]['duration'] : 5 ?>;
      let timeLeft = timerMinutes * 60; // en secondes
      const timerDisplay = document.getElementById('timer-display');
      let timerInterval;
      
      // Initialize
      function init() {
        // Show first slide
        showSlide(0);
        updateNavButtons();
        
        // Add event listeners
        prevButton.addEventListener('click', goToPreviousSlide);
        nextButton.addEventListener('click', goToNextSlide);
        
        // Add event listeners to all radio buttons
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
          radio.addEventListener('change', updateNavButtons);
        });
      }
      
      // Show slide by index
      function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
          slide.classList.remove('active');
        });
        
        // Show the current slide
        slides[index].classList.add('active');
        
        // Update progress text
        questionProgress.textContent = `${index + 1} of ${totalSlides}`;
        
        // Update current index
        currentSlideIndex = index;
      }
      
      // Go to previous slide
      function goToPreviousSlide() {
        if (currentSlideIndex > 0) {
          showSlide(currentSlideIndex - 1);
          updateNavButtons();
        }
      }
      
      // Go to next slide
      function goToNextSlide() {
   
        // 1. Récupère le nom du groupe radio de la slide courante
        const currentSlideName = `q${currentSlideIndex + 1}-answer`;
        // 2. Récupère la valeur sélectionnée
        const selected = document.querySelector(`input[name="${currentSlideName}"]:checked`);
        if (selected) {
          const value = selected.value;
          // 3. Envoie la valeur (exemple avec fetch)
          fetch('/jeu/get/point', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              question: currentSlideName,
              reponse: value
            })
          })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            // Traite la réponse si besoin
            // Passe à la slide suivante
            if (currentSlideIndex < totalSlides - 1) {
              showSlide(currentSlideIndex + 1);
              updateNavButtons();
            }
          });
        }
      }
      
      // Update navigation buttons state
      function updateNavButtons() {
        // Disable previous button on first slide
        prevButton.disabled = currentSlideIndex === 0;
        
        // Update next button text on last slide
        if (currentSlideIndex === totalSlides - 1) {
          nextButton.textContent = 'Finish';
        } else {
          nextButton.textContent = 'Next Question';
        }
        
        // Check if current slide has a selected answer
        const currentSlideName = `q${currentSlideIndex + 1}-answer`;
        const hasAnswer = document.querySelector(`input[name="${currentSlideName}"]:checked`) !== null;
        
        // Disable next button if no answer selected
        nextButton.disabled = !hasAnswer;
      }
  function startTimer() {
    updateTimerDisplay();
    timerInterval = setInterval(() => {
      timeLeft--;
      updateTimerDisplay();
      if (timeLeft <= 0) {
        clearInterval(timerInterval);
        timerDisplay.textContent = "00:00";
        nextButton.disabled = true;
        prevButton.disabled = true;
        alert("Temps écoulé !");
        // Ici tu peux soumettre automatiquement le quiz ou afficher un message
      }
    }, 1000);
  }

  function updateTimerDisplay() {
    const min = String(Math.floor(timeLeft / 60)).padStart(2, '0');
    const sec = String(timeLeft % 60).padStart(2, '0');
    timerDisplay.textContent = `${min}:${sec}`;
  }
      // Initialize the quiz
      init();
      startTimer();
    });
    //timer for quiz
    
    document.getElementById('prev-button').addEventListener('click',function(e){
       
    })
  </script>
  
</body>
</html>