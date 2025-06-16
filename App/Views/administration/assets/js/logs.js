document.addEventListener("DOMContentLoaded", () => {
  // Real-time logs simulation
  let realtimeInterval = null

  // Initialize real-time if toggle is checked
  const realtimeToggle = document.getElementById("realtimeToggle")
  if (realtimeToggle && realtimeToggle.checked) {
    startRealtimeUpdates()
  }

  // Real-time toggle functionality
  if (realtimeToggle) {
    realtimeToggle.addEventListener("change", (e) => {
      if (e.target.checked) {
        startRealtimeUpdates()
      } else {
        stopRealtimeUpdates()
      }
    })
  }

  // Log level filter functionality
  const filterButtons = document.querySelectorAll(".filter-btn")
  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const filterGroup = button.closest(".filter-buttons")
      filterGroup.querySelectorAll(".filter-btn").forEach((btn) => btn.classList.remove("active"))
      button.classList.add("active")

      const level = button.dataset.level
      filterLogsByLevel(level)
    })
  })

  // Search functionality
  const searchInput = document.querySelector(".search-filter input")
  if (searchInput) {
    searchInput.addEventListener("input", (e) => {
      const searchTerm = e.target.value.toLowerCase()
      filterLogsBySearch(searchTerm)
    })
  }

  // Log details modal functionality
  const detailsButtons = document.querySelectorAll(".details-btn")
  const modal = document.getElementById("logDetailsModal")
  const closeModalBtn = document.querySelector(".close-modal")

  detailsButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const logEntry = e.target.closest(".log-entry")
      showLogDetails(logEntry)
    })
  })

  if (closeModalBtn) {
    closeModalBtn.addEventListener("click", () => {
      modal.classList.remove("active")
    })
  }

  // Close modal when clicking outside
  if (modal) {
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.classList.remove("active")
      }
    })
  }

  // Load more functionality
  const loadMoreBtn = document.querySelector(".load-more-btn")
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", () => {
      loadMoreLogs()
    })
  }

  // Export functionality
  const exportBtn = document.querySelector(".export-btn")
  if (exportBtn) {
    exportBtn.addEventListener("click", () => {
      exportLogs()
    })
  }

  // Refresh functionality
  const refreshBtn = document.querySelector(".refresh-btn")
  if (refreshBtn) {
    refreshBtn.addEventListener("click", () => {
      refreshLogs()
    })
  }

  function startRealtimeUpdates() {
    console.log("Starting real-time log updates...")
    realtimeInterval = setInterval(() => {
      addNewLogEntry()
    }, 5000) // Add new log every 5 seconds
  }

  function stopRealtimeUpdates() {
    console.log("Stopping real-time log updates...")
    if (realtimeInterval) {
      clearInterval(realtimeInterval)
      realtimeInterval = null
    }
  }

  function addNewLogEntry() {
    const logsTable = document.querySelector(".logs-table")
    if (!logsTable) return

    const logTypes = ["info", "warning", "error", "success"]
    const sources = ["AUTH", "QUIZ", "USER", "SYSTEM"]
    const messages = [
      "Nouvelle connexion utilisateur détectée",
      "Quiz complété avec succès",
      "Tentative de connexion échouée",
      "Sauvegarde automatique effectuée",
      "Nouveau compte créé",
      "Erreur de base de données détectée",
    ]

    const randomType = logTypes[Math.floor(Math.random() * logTypes.length)]
    const randomSource = sources[Math.floor(Math.random() * sources.length)]
    const randomMessage = messages[Math.floor(Math.random() * messages.length)]

    const now = new Date()
    const time = now.toLocaleTimeString("fr-FR")
    const date = now.toLocaleDateString("fr-FR")

    const newLogEntry = document.createElement("div")
    newLogEntry.className = `log-entry ${randomType}`
    newLogEntry.innerHTML = `
      <div class="log-time">
        <span class="time">${time}</span>
        <span class="date">${date}</span>
      </div>
      <div class="log-level ${randomType}">
        <i class="fas fa-${getIconForType(randomType)}"></i>
        ${randomType.toUpperCase()}
      </div>
      <div class="log-source">${randomSource}</div>
      <div class="log-message">${randomMessage}</div>
      <div class="log-details">
        <button class="details-btn" title="Voir les détails">
          <i class="fas fa-chevron-down"></i>
        </button>
      </div>
    `

    // Add event listener to new details button
    const detailsBtn = newLogEntry.querySelector(".details-btn")
    detailsBtn.addEventListener("click", (e) => {
      const logEntry = e.target.closest(".log-entry")
      showLogDetails(logEntry)
    })

    // Insert at the beginning
    logsTable.insertBefore(newLogEntry, logsTable.firstChild)

    // Add animation
    newLogEntry.style.opacity = "0"
    newLogEntry.style.transform = "translateY(-20px)"

    setTimeout(() => {
      newLogEntry.style.transition = "all 0.3s ease"
      newLogEntry.style.opacity = "1"
      newLogEntry.style.transform = "translateY(0)"
    }, 100)

    // Update stats
    updateLogStats(randomType)
  }

  function getIconForType(type) {
    const icons = {
      info: "info-circle",
      warning: "exclamation-triangle",
      error: "times-circle",
      success: "check-circle",
    }
    return icons[type] || "info-circle"
  }

  function updateLogStats(type) {
    const statCard = document.querySelector(`.log-stat-card.${type} .log-stat-content p`)
    if (statCard) {
      const currentValue = Number.parseInt(statCard.textContent)
      statCard.textContent = currentValue + 1
    }
  }

  function filterLogsByLevel(level) {
    const logEntries = document.querySelectorAll(".log-entry")
    logEntries.forEach((entry) => {
      if (level === "all" || entry.classList.contains(level)) {
        entry.style.display = "grid"
      } else {
        entry.style.display = "none"
      }
    })
  }

  function filterLogsBySearch(searchTerm) {
    const logEntries = document.querySelectorAll(".log-entry")
    logEntries.forEach((entry) => {
      const message = entry.querySelector(".log-message").textContent.toLowerCase()
      const source = entry.querySelector(".log-source").textContent.toLowerCase()

      if (message.includes(searchTerm) || source.includes(searchTerm)) {
        entry.style.display = "grid"
      } else {
        entry.style.display = "none"
      }
    })
  }

  function showLogDetails(logEntry) {
    const modal = document.getElementById("logDetailsModal")
    if (!modal) return

    // Extract log data
    const time = logEntry.querySelector(".log-time .time").textContent
    const date = logEntry.querySelector(".log-time .date").textContent
    const level = logEntry.querySelector(".log-level").textContent.trim()
    const source = logEntry.querySelector(".log-source").textContent
    const message = logEntry.querySelector(".log-message").textContent

    // Populate modal with data
    const modalBody = modal.querySelector(".modal-body")
    modalBody.innerHTML = `
      <div class="detail-row">
        <label>Timestamp:</label>
        <span>${date} ${time}</span>
      </div>
      <div class="detail-row">
        <label>Niveau:</label>
        <span class="log-level ${level.toLowerCase()}">${level}</span>
      </div>
      <div class="detail-row">
        <label>Source:</label>
        <span>${source}</span>
      </div>
      <div class="detail-row">
        <label>Utilisateur:</label>
        <span>john.doe@email.com</span>
      </div>
      <div class="detail-row">
        <label>IP:</label>
        <span>192.168.1.100</span>
      </div>
      <div class="detail-row">
        <label>User Agent:</label>
        <span>Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36</span>
      </div>
      <div class="detail-row">
        <label>Message complet:</label>
        <div class="log-message-full">${message}</div>
      </div>
    `

    modal.classList.add("active")
  }

  function loadMoreLogs() {
    console.log("Loading more logs...")
    const loadMoreBtn = document.querySelector(".load-more-btn")

    // Add loading state
    loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Chargement...'
    loadMoreBtn.disabled = true

    // Simulate loading delay
    setTimeout(() => {
      // Add some mock logs
      for (let i = 0; i < 10; i++) {
        addNewLogEntry()
      }

      // Reset button
      loadMoreBtn.innerHTML = '<i class="fas fa-chevron-down"></i> Charger plus de logs'
      loadMoreBtn.disabled = false
    }, 1000)
  }

  function exportLogs() {
    console.log("Exporting logs...")

    // Create CSV content
    const logEntries = document.querySelectorAll(".log-entry")
    let csvContent = "Timestamp,Level,Source,Message\n"

    logEntries.forEach((entry) => {
      const time = entry.querySelector(".log-time .time").textContent
      const date = entry.querySelector(".log-time .date").textContent
      const level = entry.querySelector(".log-level").textContent.trim()
      const source = entry.querySelector(".log-source").textContent
      const message = entry.querySelector(".log-message").textContent

      csvContent += `"${date} ${time}","${level}","${source}","${message}"\n`
    })

    // Create and download file
    const blob = new Blob([csvContent], { type: "text/csv" })
    const url = window.URL.createObjectURL(blob)
    const a = document.createElement("a")
    a.href = url
    a.download = `logs_${new Date().toISOString().split("T")[0]}.csv`
    document.body.appendChild(a)
    a.click()
    document.body.removeChild(a)
    window.URL.revokeObjectURL(url)
  }

  function refreshLogs() {
    console.log("Refreshing logs...")
    const refreshBtn = document.querySelector(".refresh-btn")
    const icon = refreshBtn.querySelector("i")

    // Add spinning animation
    icon.style.animation = "spin 1s linear infinite"

    // Simulate refresh delay
    setTimeout(() => {
      icon.style.animation = ""
      console.log("Logs refreshed")
    }, 1000)
  }
})
