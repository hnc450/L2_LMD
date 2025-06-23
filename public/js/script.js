document.addEventListener("DOMContentLoaded", () => {
  // Toggle mobile menu
  const menuToggle = document.getElementById("menuToggle")
  const sidebar = document.querySelector(".sidebar")

  if (menuToggle) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.toggle("active")
    })
  }

  // Close sidebar when clicking outside
  document.addEventListener("click", (event) => {
    if (
      sidebar &&
      sidebar.classList.contains("active") &&
      !sidebar.contains(event.target) &&
      event.target !== menuToggle
    ) {
      sidebar.classList.remove("active")
    }
  })

  // Theme switcher
  const themeOptions = document.querySelectorAll(".theme-option")

  if (themeOptions.length > 0) {
    themeOptions.forEach((option) => {
      option.addEventListener("click", function () {
        const theme = this.getAttribute("data-theme")

        // Remove active class from all options
        themeOptions.forEach((opt) => opt.classList.remove("active"))

        // Add active class to clicked option
        this.classList.add("active")

        // Apply theme
        document.body.className = theme + "-theme"

        // Save theme preference
        localStorage.setItem("theme", theme)

        // Add animation to show theme change
        document.body.classList.add("fade-in")
        setTimeout(() => {
          document.body.classList.remove("fade-in")
        }, 500)
      })
    })

    // Load saved theme
    const savedTheme = localStorage.getItem("theme")
    if (savedTheme) {
      document.body.className = savedTheme + "-theme"
      themeOptions.forEach((option) => {
        if (option.getAttribute("data-theme") === savedTheme) {
          option.classList.add("active")
        } else {
          option.classList.remove("active")
        }
      })
    }
  }

  // Appliquer le thème sauvegardé dès le chargement
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme) {
    document.body.className = savedTheme + "-theme";
  }

  // Filter buttons in games page
  const filterButtons = document.querySelectorAll(".filter-btn")

  if (filterButtons.length > 0) {
    filterButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const parent = this.parentElement
        const siblings = parent.querySelectorAll(".filter-btn")

        siblings.forEach((sibling) => sibling.classList.remove("active"))
        this.classList.add("active")

        // Add animation to game cards
        const gameCards = document.querySelectorAll(".game-card")
        gameCards.forEach((card) => {
          card.classList.add("fade-in")
          setTimeout(() => {
            card.classList.remove("fade-in")
          }, 500)
        })
      })
    })
  }

  // Animate elements on scroll
  const animateOnScroll = () => {
    const elements = document.querySelectorAll(".slide-container, .module-card, .trophy-card, .game-card, .league-card")

    elements.forEach((element) => {
      const elementPosition = element.getBoundingClientRect().top
      const windowHeight = window.innerHeight

      if (elementPosition < windowHeight - 50) {
        element.classList.add("slide-in-up")
      }
    })
  }

  // Run animation on load
  setTimeout(animateOnScroll, 300)

  // Run animation on scroll
  window.addEventListener("scroll", animateOnScroll)

  // Add hover effects for cards
  const cards = document.querySelectorAll(".slide-container, .module-card, .trophy-card, .game-card, .league-card")

  cards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-5px)"
      this.style.boxShadow = "0 10px 20px rgba(0, 0, 0, 0.2)"
    })

    card.addEventListener("mouseleave", function () {
      this.style.transform = ""
      this.style.boxShadow = ""
    })
  })

  // Form validation for settings page
  const settingsForms = document.querySelectorAll(".settings-form")

  if (settingsForms.length > 0) {
    settingsForms.forEach((form) => {
      form.addEventListener("submit", (event) => {
        event.preventDefault()

        // Show success message
        const successMessage = document.createElement("div")
        successMessage.className = "success-message"
        successMessage.innerHTML = '<i class="fas fa-check-circle"></i> Modifications enregistrées avec succès!'
        successMessage.style.backgroundColor = "var(--success-color)"
        successMessage.style.color = "white"
        successMessage.style.padding = "var(--spacing-md)"
        successMessage.style.borderRadius = "var(--border-radius-sm)"
        successMessage.style.marginTop = "var(--spacing-md)"
        successMessage.style.display = "flex"
        successMessage.style.alignItems = "center"
        successMessage.style.animation = "fadeIn 0.3s ease-in-out"

        const icon = successMessage.querySelector("i")
        icon.style.marginRight = "var(--spacing-sm)"

        form.appendChild(successMessage)

        // Remove message after 3 seconds
        setTimeout(() => {
          successMessage.style.animation = "fadeOut 0.3s ease-in-out"
          setTimeout(() => {
            form.removeChild(successMessage)
          }, 300)
        }, 3000)
      })
    })
  }

  // Logout button
  const logoutBtn = document.querySelector(".logout-btn")

  if (logoutBtn) {
    logoutBtn.addEventListener("click", () => {
      if (confirm("Êtes-vous sûr de vouloir vous déconnecter?")) {
        // Redirect to login page (in a real app)
        alert("Vous avez été déconnecté.")
        window.location.href = "/deconnexion"
      }
    })
  }

  
  // Play button for games
  const playButtons = document.querySelectorAll(".btn-play")

  if (playButtons.length > 0) {
    playButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const gameName = this.closest(".game-card").querySelector("h3").textContent
        alert("Lancement du jeu: " + gameName)
        // In a real app, this would redirect to the game page
      })
    })
  }

  // --- FILTRAGE DES JEUX PAR CATÉGORIE, ÂGE ET DIFFICULTÉ ---
  const gamesGrid = document.querySelector('.games-grid');
  if (gamesGrid) {
    let selectedCategory = 'Tous';
    let selectedAge = 'Tous';
    let selectedLevel = 'Tous';

    // Sélection des groupes de filtres
    const filterGroups = document.querySelectorAll('.games-filters .filter-group');
    filterGroups.forEach((group) => {
      group.addEventListener('click', (e) => {
        if (e.target.classList.contains('filter-btn')) {
          // Mettre à jour le filtre sélectionné
          const label = group.querySelector('label').textContent.trim();
          const value = e.target.textContent.trim();
          if (label === 'Catégorie') selectedCategory = value;
          if (label === 'Âge') selectedAge = value;
          if (label === 'Difficulté') selectedLevel = value;
          // Appliquer le filtrage
          filterGames();
        }
      });
    });

    function filterGames() {
      const cards = gamesGrid.querySelectorAll('.game-card');
      cards.forEach((card) => {
        // Récupérer les infos du jeu
        const title = card.querySelector('h3').textContent.toLowerCase();
        const badge = card.querySelector('.game-badge').textContent.trim();
        const desc = card.querySelector('p').textContent.toLowerCase();
        // Catégorie
        let matchCategory = (selectedCategory === 'Tous') || title.includes(selectedCategory.toLowerCase()) || desc.includes(selectedCategory.toLowerCase());
        // Âge
        let matchAge = (selectedAge === 'Tous') || badge === selectedAge;
        // Difficulté
        let matchLevel = (selectedLevel === 'Tous') || desc.includes(selectedLevel.toLowerCase()) || title.includes(selectedLevel.toLowerCase());
        // Affichage
        if (matchCategory && matchAge && matchLevel) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }
  }
})
