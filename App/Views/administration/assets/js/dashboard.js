document.addEventListener("DOMContentLoaded", () => {
  // Tab functionality
  const tabButtons = document.querySelectorAll(".tab-btn")
  const tabContents = document.querySelectorAll(".tab-content")

  if (tabButtons.length > 0) {
    tabButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const targetTab = button.dataset.tab

        // Remove active class from all buttons and contents
        tabButtons.forEach((btn) => btn.classList.remove("active"))
        tabContents.forEach((content) => content.classList.remove("active"))

        // Add active class to clicked button and corresponding content
        button.classList.add("active")
        const targetContent = document.getElementById(`${targetTab}-tab`)
        if (targetContent) {
          targetContent.classList.add("active")
        }
      })
    })
  }

  // Filter functionality for content management
  const filterButtons = document.querySelectorAll(".filter-btn")
  if (filterButtons.length > 0) {
    filterButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const filterGroup = button.closest(".filter-buttons")
        filterGroup.querySelectorAll(".filter-btn").forEach((btn) => btn.classList.remove("active"))
        button.classList.add("active")

        // Add filter logic here based on data attributes
        const filterLevel = button.dataset.level
        if (filterLevel) {
          filterLogs(filterLevel)
        }
      })
    })
  }

  // Search functionality
  const searchInputs = document.querySelectorAll(".search-filter input")
  if (searchInputs.length > 0) {
    searchInputs.forEach((input) => {
      input.addEventListener("input", (e) => {
        const searchTerm = e.target.value.toLowerCase()
        // Add search logic here
        console.log("Searching for:", searchTerm)
      })
    })
  }

  // Action buttons
  const actionButtons = document.querySelectorAll(".action-btn")
  if (actionButtons.length > 0) {
    actionButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const action = button.textContent.trim()
        console.log("Action clicked:", action)
        // Add action logic here
      })
    })
  }

  // File upload functionality
  const uploadZone = document.querySelector(".upload-zone")
  const fileInput = document.querySelector(".upload-zone input[type='file']")

  if (uploadZone && fileInput) {
    uploadZone.addEventListener("dragover", (e) => {
      e.preventDefault()
      uploadZone.style.borderColor = "var(--primary-color)"
      uploadZone.style.background = "rgba(138, 43, 226, 0.1)"
    })

    uploadZone.addEventListener("dragleave", (e) => {
      e.preventDefault()
      uploadZone.style.borderColor = "var(--border-color)"
      uploadZone.style.background = "transparent"
    })

    uploadZone.addEventListener("drop", (e) => {
      e.preventDefault()
      uploadZone.style.borderColor = "var(--border-color)"
      uploadZone.style.background = "transparent"

      const files = e.dataTransfer.files
      handleFileUpload(files)
    })

    fileInput.addEventListener("change", (e) => {
      const files = e.target.files
      handleFileUpload(files)
    })
  }

  function handleFileUpload(files) {
    Array.from(files).forEach((file) => {
      console.log("Uploading file:", file.name)
      // Add upload logic here
    })
  }

  // Filter logs function
  function filterLogs(level) {
    const logEntries = document.querySelectorAll(".log-entry")
    logEntries.forEach((entry) => {
      const logLevel = entry.querySelector(".log-level")
      if (level === "all" || logLevel.classList.contains(level)) {
        entry.style.display = "grid"
      } else {
        entry.style.display = "none"
      }
    })
  }

  // Real-time toggle
  const realtimeToggle = document.getElementById("realtimeToggle")
  if (realtimeToggle) {
    realtimeToggle.addEventListener("change", (e) => {
      if (e.target.checked) {
        console.log("Real-time mode enabled")
        // Start real-time updates
      } else {
        console.log("Real-time mode disabled")
        // Stop real-time updates
      }
    })
  }

  // Refresh button
  const refreshBtn = document.querySelector(".refresh-btn")
  if (refreshBtn) {
    refreshBtn.addEventListener("click", () => {
      console.log("Refreshing data...")
      // Add refresh logic here

      // Add loading animation
      const icon = refreshBtn.querySelector("i")
      icon.style.animation = "spin 1s linear infinite"

      setTimeout(() => {
        icon.style.animation = ""
      }, 1000)
    })
  }

  // Export button
  const exportBtn = document.querySelector(".export-btn")
  if (exportBtn) {
    exportBtn.addEventListener("click", () => {
      console.log("Exporting data...")
      // Add export logic here
    })
  }

  // Log details functionality
  const detailsButtons = document.querySelectorAll(".details-btn")
  const logDetailsModal = document.getElementById("logDetailsModal")
  const closeModal = document.querySelector(".close-modal")

  if (detailsButtons.length > 0 && logDetailsModal) {
    detailsButtons.forEach((button) => {
      button.addEventListener("click", () => {
        logDetailsModal.classList.add("active")
        // Populate modal with log details
      })
    })

    if (closeModal) {
      closeModal.addEventListener("click", () => {
        logDetailsModal.classList.remove("active")
      })
    }

    // Close modal when clicking outside
    logDetailsModal.addEventListener("click", (e) => {
      if (e.target === logDetailsModal) {
        logDetailsModal.classList.remove("active")
      }
    })
  }

  // Load more logs
  const loadMoreBtn = document.querySelector(".load-more-btn")
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", () => {
      console.log("Loading more logs...")
      // Add load more logic here
    })
  }

  // Time range selector
  const timeButtons = document.querySelectorAll(".time-btn")
  if (timeButtons.length > 0) {
    timeButtons.forEach((button) => {
      button.addEventListener("click", () => {
        timeButtons.forEach((btn) => btn.classList.remove("active"))
        button.classList.add("active")

        const range = button.dataset.range
        console.log("Time range changed to:", range)
        // Update charts and data based on time range
      })
    })
  }
})

// CSS animation for spinning refresh icon
const style = document.createElement("style")
style.textContent = `
  @keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
`
document.head.appendChild(style)
