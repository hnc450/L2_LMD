import { Chart } from "@/components/ui/chart"
// Dashboard administrateur
document.addEventListener("DOMContentLoaded", () => {
  // Vérifier l'authentification
  if (localStorage.getItem("adminLoggedIn") !== "true") {
    window.location.href = "login.html"
    return
  }

  // Initialiser le dashboard
  initDashboard()

  function initDashboard() {
    // Initialiser les graphiques
    initCharts()

    // Gérer les boutons de contrôle des graphiques
    initChartControls()

    // Gérer le bouton de déconnexion
    initLogout()

    // Gérer l'actualisation des données
    initRefresh()

    // Gérer le changement de période
    initDateRange()

    // Charger les données initiales
    loadDashboardData()
  }

  function initCharts() {
    // Graphique des utilisateurs actifs
    const usersCtx = document.getElementById("usersChart").getContext("2d")
    window.usersChart = new Chart(usersCtx, {
      type: "line",
      data: {
        labels: ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
        datasets: [
          {
            label: "Utilisateurs actifs",
            data: [120, 190, 300, 500, 200, 300, 450],
            borderColor: "rgb(37, 99, 235)",
            backgroundColor: "rgba(37, 99, 235, 0.1)",
            tension: 0.4,
            fill: true,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: "rgba(0, 0, 0, 0.1)",
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    })

    // Graphique des catégories
    const categoriesCtx = document.getElementById("categoriesChart").getContext("2d")
    window.categoriesChart = new Chart(categoriesCtx, {
      type: "doughnut",
      data: {
        labels: ["Géographie", "Histoire", "Sciences", "Culture"],
        datasets: [
          {
            data: [35, 25, 20, 20],
            backgroundColor: ["rgb(37, 99, 235)", "rgb(16, 185, 129)", "rgb(245, 158, 11)", "rgb(239, 68, 68)"],
            borderWidth: 0,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              padding: 20,
              usePointStyle: true,
            },
          },
        },
      },
    })
  }

  function initChartControls() {
    const chartButtons = document.querySelectorAll(".chart-btn")

    chartButtons.forEach((button) => {
      button.addEventListener("click", function () {
        // Retirer la classe active de tous les boutons
        chartButtons.forEach((btn) => btn.classList.remove("active"))

        // Ajouter la classe active au bouton cliqué
        this.classList.add("active")

        // Mettre à jour le graphique selon la période
        const period = this.dataset.period
        updateUsersChart(period)
      })
    })
  }

  function updateUsersChart(period) {
    let labels, data

    switch (period) {
      case "day":
        labels = ["00h", "04h", "08h", "12h", "16h", "20h"]
        data = [45, 25, 80, 150, 200, 120]
        break
      case "week":
        labels = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"]
        data = [120, 190, 300, 500, 200, 300, 450]
        break
      case "month":
        labels = ["Sem 1", "Sem 2", "Sem 3", "Sem 4"]
        data = [1200, 1900, 1500, 1800]
        break
    }

    window.usersChart.data.labels = labels
    window.usersChart.data.datasets[0].data = data
    window.usersChart.update()
  }

  function initLogout() {
    const logoutBtn = document.getElementById("logoutBtn")

    logoutBtn.addEventListener("click", () => {
      if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
        localStorage.removeItem("adminLoggedIn")
        localStorage.removeItem("adminUsername")
        localStorage.removeItem("adminRememberMe")
        window.location.href = "login.html"
      }
    })
  }

  function initRefresh() {
    const refreshBtn = document.getElementById("refreshData")

    refreshBtn.addEventListener("click", function () {
      // Animation de chargement
      this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Actualisation...'
      this.disabled = true

      // Simuler le chargement des données
      setTimeout(() => {
        loadDashboardData()
        this.innerHTML = '<i class="fas fa-sync-alt"></i> Actualiser'
        this.disabled = false

        // Notification de succès
        showNotification("Données actualisées avec succès", "success")
      }, 2000)
    })
  }

  function initDateRange() {
    const dateRange = document.getElementById("dateRange")

    dateRange.addEventListener("change", function () {
      const period = this.value
      loadDashboardData(period)
      showNotification(`Période changée: ${period} jours`, "info")
    })
  }

  function loadDashboardData(period = 30) {
    // Simuler le chargement des données depuis une API
    console.log(`Chargement des données pour ${period} jours`)

    // Ici, vous feriez un appel API réel
    // fetch(`/api/admin/dashboard?period=${period}`)
    //     .then(response => response.json())
    //     .then(data => updateDashboard(data));

    // Pour la démo, on utilise des données fictives
    updateDashboard({
      activeUsers: 2847,
      gamesPlayed: 15632,
      totalPlayTime: "1,247h",
      successRate: 73.2,
      topPlayers: [
        { name: "Marie Dubois", points: 15420, games: 342, successRate: 89.2 },
        { name: "Thomas Martin", points: 14850, games: 298, successRate: 85.7 },
      ],
    })
  }

  function updateDashboard(data) {
    // Mettre à jour les statistiques principales
    document.querySelector(".stat-card:nth-child(1) .stat-number").textContent = data.activeUsers.toLocaleString()
    document.querySelector(".stat-card:nth-child(2) .stat-number").textContent = data.gamesPlayed.toLocaleString()
    document.querySelector(".stat-card:nth-child(3) .stat-number").textContent = data.totalPlayTime
    document.querySelector(".stat-card:nth-child(4) .stat-number").textContent = data.successRate + "%"

    // Animation des compteurs
    animateCounters()
  }

  function animateCounters() {
    const counters = document.querySelectorAll(".stat-number")

    counters.forEach((counter) => {
      const target = Number.parseInt(counter.textContent.replace(/[^\d]/g, ""))
      const increment = target / 100
      let current = 0

      const timer = setInterval(() => {
        current += increment
        if (current >= target) {
          current = target
          clearInterval(timer)
        }

        if (counter.textContent.includes(",")) {
          counter.textContent = Math.floor(current).toLocaleString()
        } else if (counter.textContent.includes("%")) {
          counter.textContent = Math.floor(current) + "%"
        } else if (counter.textContent.includes("h")) {
          counter.textContent = Math.floor(current) + "h"
        } else {
          counter.textContent = Math.floor(current)
        }
      }, 20)
    })
  }

  function showNotification(message, type = "info") {
    const notification = document.createElement("div")
    notification.className = `notification ${type}`
    notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `

    switch (type) {
      case "success":
        notification.style.background = "var(--admin-success)"
        break
      case "error":
        notification.style.background = "var(--admin-danger)"
        break
      case "info":
      default:
        notification.style.background = "var(--admin-primary)"
        break
    }

    notification.textContent = message
    document.body.appendChild(notification)

    // Animation d'apparition
    setTimeout(() => {
      notification.style.transform = "translateX(0)"
    }, 100)

    // Suppression automatique
    setTimeout(() => {
      notification.style.transform = "translateX(100%)"
      setTimeout(() => {
        if (notification.parentNode) {
          notification.remove()
        }
      }, 300)
    }, 3000)
  }
})
