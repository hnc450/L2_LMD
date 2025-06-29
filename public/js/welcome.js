document.addEventListener("DOMContentLoaded", () => {
  const welcomeSlides = document.getElementById("welcomeSlides")
  const welcomeDots = document.querySelectorAll(".welcome-dot")
  const welcomeNext = document.getElementById("welcomeNext")

  if (welcomeSlides && welcomeDots.length > 0 && welcomeNext) {
    let currentSlide = 0
    const totalSlides = welcomeDots.length

    // Function to show a specific slide
    const showSlide = (index) => {
      // Hide all slides
      const slides = welcomeSlides.querySelectorAll(".welcome-slide")
      slides.forEach((slide) => {
        slide.classList.remove("active")
      })

      // Remove active class from all dots
      welcomeDots.forEach((dot) => {
        dot.classList.remove("active")
      })

      // Show the selected slide and dot
      slides[index].classList.add("active")
      welcomeDots[index].classList.add("active")

      // Update next button text for last slide
      if (index === totalSlides - 1) {
        welcomeNext.textContent = "Commencer"
      } else {
        welcomeNext.innerHTML = 'Suivant <i class="fas fa-arrow-right"></i>'
      }

      // Update current slide
      currentSlide = index
    }

    // Next button click
    welcomeNext.addEventListener("click", () => {
      if (currentSlide < totalSlides - 1) {
        showSlide(currentSlide + 1)
      } else {
        // Last slide, redirect to home page
        window.location.href = "/user/home";
      }
    })

    // Dot click
    welcomeDots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        showSlide(index)
      })
    })

    // Swipe functionality
    let touchStartX = 0
    let touchEndX = 0

    welcomeSlides.addEventListener("touchstart", (e) => {
      touchStartX = e.changedTouches[0].screenX
    })

    welcomeSlides.addEventListener("touchend", (e) => {
      touchEndX = e.changedTouches[0].screenX
      handleSwipe()
    })

    const handleSwipe = () => {
      const swipeThreshold = 50

      if (touchEndX < touchStartX - swipeThreshold) {
        // Swipe left, go to next slide
        if (currentSlide < totalSlides - 1) {
          showSlide(currentSlide + 1)
        }
      } else if (touchEndX > touchStartX + swipeThreshold) {
        // Swipe right, go to previous slide
        if (currentSlide > 0) {
          showSlide(currentSlide - 1)
        }
      }
    }
  }
})
