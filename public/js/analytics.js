import { Chart } from "@/components/ui/chart"

// Configuration des dates pour les filtres
const dateRanges = {
    today: {
        label: "Aujourd'hui",
        start: new Date(),
        end: new Date()
    },
    yesterday: {
        label: "Hier",
        start: new Date(Date.now() - 86400000),
        end: new Date(Date.now() - 86400000)
    },
    last7days: {
        label: "7 derniers jours",
        start: new Date(Date.now() - 7 * 86400000),
        end: new Date()
    },
    last30days: {
        label: "30 derniers jours",
        start: new Date(Date.now() - 30 * 86400000),
        end: new Date()
    },
    thisMonth: {
        label: "Ce mois",
        start: new Date(new Date().getFullYear(), new Date().getMonth(), 1),
        end: new Date()
    },
    lastMonth: {
        label: "Mois dernier",
        start: new Date(new Date().getFullYear(), new Date().getMonth() - 1, 1),
        end: new Date(new Date().getFullYear(), new Date().getMonth(), 0)
    }
};

// Données de démonstration pour les graphiques
const demoData = {
    users: {
        labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
        datasets: [{
            label: 'Utilisateurs actifs',
            data: [65, 59, 80, 81, 56, 55, 40],
            borderColor: '#4CAF50',
            tension: 0.4
        }]
    },
    content: {
        labels: ['Quiz', 'Modules', 'Explorations', 'Médias'],
        datasets: [{
            label: 'Contenu créé',
            data: [12, 19, 3, 5],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
        }]
    },
    engagement: {
        labels: ['0-5 min', '5-15 min', '15-30 min', '30-60 min', '60+ min'],
        datasets: [{
            label: 'Temps d\'engagement',
            data: [30, 45, 15, 8, 2],
            backgroundColor: '#9C27B0'
        }]
    }
};

document.addEventListener("DOMContentLoaded", () => {
  // Initialize charts when the page loads
  initializeCharts()

  // Time range selector functionality
  const timeButtons = document.querySelectorAll(".time-btn")
  timeButtons.forEach((button) => {
    button.addEventListener("click", () => {
      timeButtons.forEach((btn) => btn.classList.remove("active"))
      button.classList.add("active")

      const range = button.dataset.range
      updateChartsForTimeRange(range)
    })
  })

  // Initialiser les filtres de date
  initializeDateFilters()

  // Ajouter des animations aux cartes de statistiques
  const statCards = document.querySelectorAll('.stat-card')
  statCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.classList.add('hover')
    })
    card.addEventListener('mouseleave', () => {
      card.classList.remove('hover')
    })
  })
})

function initializeCharts() {
  // Mini charts for metrics
  createMiniChart("usersChart", [12, 19, 15, 25, 22, 30, 28])
  createMiniChart("sessionsChart", [8, 15, 12, 20, 18, 25, 23])
  createMiniChart("engagementChart", [5, 8, 12, 15, 18, 22, 24])
  createMiniChart("completionChart", [85, 82, 78, 75, 73, 76, 78])

  // Main user evolution chart
  createUserEvolutionChart()

  // Age distribution pie chart
  createAgeDistributionChart()

  // Categories bar chart
  createCategoriesChart()

  // Hourly performance chart
  createHourlyChart()

  // Initialiser les graphiques
  charts = initializeCharts()
}

function createMiniChart(canvasId, data) {
  const ctx = document.getElementById(canvasId)
  if (!ctx) return

  new Chart(ctx, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [
        {
          data: data,
          borderColor: "#8a2be2",
          backgroundColor: "rgba(138, 43, 226, 0.1)",
          borderWidth: 2,
          fill: true,
          tension: 0.4,
          pointRadius: 0,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
      },
      scales: {
        x: { display: false },
        y: { display: false },
      },
      elements: {
        point: { radius: 0 },
      },
    },
  })
}

function createUserEvolutionChart() {
  const ctx = document.getElementById("userEvolutionChart")
  if (!ctx) return

  new Chart(ctx, {
    type: "line",
    data: {
      labels: ["Jan", "Fév", "Mar", "Avr", "Mai", "Jun", "Jul", "Aoû", "Sep", "Oct", "Nov", "Déc"],
      datasets: [
        {
          label: "Utilisateurs actifs",
          data: [1200, 1350, 1100, 1400, 1600, 1800, 2100, 2300, 2000, 2200, 2400, 2456],
          borderColor: "#8a2be2",
          backgroundColor: "rgba(138, 43, 226, 0.1)",
          borderWidth: 3,
          fill: true,
          tension: 0.4,
        },
        {
          label: "Nouveaux utilisateurs",
          data: [200, 250, 180, 300, 350, 400, 450, 500, 420, 480, 520, 567],
          borderColor: "#17a2b8",
          backgroundColor: "rgba(23, 162, 184, 0.1)",
          borderWidth: 3,
          fill: true,
          tension: 0.4,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "top",
          labels: {
            usePointStyle: true,
            padding: 20,
          },
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
}

function createAgeDistributionChart() {
  const ctx = document.getElementById("ageDistributionChart")
  if (!ctx) return

  new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: ["6-8 ans", "9-11 ans", "12-14 ans", "15+ ans"],
      datasets: [
        {
          data: [25, 35, 25, 15],
          backgroundColor: ["#4caf50", "#ff9800", "#2196f3", "#e91e63"],
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
            usePointStyle: true,
            padding: 15,
          },
        },
      },
    },
  })
}

function createCategoriesChart() {
  const ctx = document.getElementById("categoriesChart")
  if (!ctx) return

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Géographie", "Histoire", "Sciences", "Culture"],
      datasets: [
        {
          label: "Sessions",
          data: [2456, 1987, 1654, 1234],
          backgroundColor: ["#4caf50", "#ff9800", "#2196f3", "#e91e63"],
          borderRadius: 8,
          borderSkipped: false,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
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
}

function createHourlyChart() {
  const ctx = document.getElementById("hourlyChart")
  if (!ctx) return

  new Chart(ctx, {
    type: "line",
    data: {
      labels: ["00h", "04h", "08h", "12h", "16h", "20h"],
      datasets: [
        {
          label: "Activité",
          data: [5, 8, 25, 45, 60, 35],
          borderColor: "#8a2be2",
          backgroundColor: "rgba(138, 43, 226, 0.1)",
          borderWidth: 3,
          fill: true,
          tension: 0.4,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
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
}

function updateChartsForTimeRange(range) {
  console.log("Updating charts for time range:", range)
  // Here you would typically fetch new data based on the time range
  // and update all charts with the new data

  // For demo purposes, we'll just log the range
  // In a real application, you would make API calls here
}

// Gestion des filtres de date
function initializeDateFilters() {
    const dateFilter = document.getElementById('dateFilter')
    if (!dateFilter) return

    // Créer les options de filtre
    Object.entries(dateRanges).forEach(([key, range]) => {
        const option = document.createElement('option')
        option.value = key
        option.textContent = range.label
        dateFilter.appendChild(option)
    })

    // Gérer le changement de filtre
    dateFilter.addEventListener('change', (e) => {
        const selectedRange = dateRanges[e.target.value]
        updateChartsWithDateRange(selectedRange)
    })
}

// Mise à jour des graphiques avec la plage de dates sélectionnée
function updateChartsWithDateRange(dateRange) {
    // Simuler le chargement
    showLoadingState()

    // Simuler une requête API
    setTimeout(() => {
        // Mettre à jour les données des graphiques
        updateChartData(dateRange)
        hideLoadingState()
    }, 500)
}

// État de chargement
function showLoadingState() {
    const charts = document.querySelectorAll('.chart-container')
    charts.forEach(chart => {
        chart.classList.add('loading')
    })
}

function hideLoadingState() {
    const charts = document.querySelectorAll('.chart-container')
    charts.forEach(chart => {
        chart.classList.remove('loading')
    })
}

// Mise à jour des données des graphiques
function updateChartData(dateRange) {
    // Simuler de nouvelles données basées sur la plage de dates
    const newData = generateRandomData(dateRange)
    
    // Mettre à jour les graphiques
    charts.userChart.data.datasets[0].data = newData.users
    charts.contentChart.data.datasets[0].data = newData.content
    charts.engagementChart.data.datasets[0].data = newData.engagement

    // Mettre à jour les graphiques
    charts.userChart.update()
    charts.contentChart.update()
    charts.engagementChart.update()

    // Mettre à jour les statistiques
    updateStats(newData.stats)
}

// Génération de données aléatoires pour la démo
function generateRandomData(dateRange) {
    return {
        users: Array.from({length: 7}, () => Math.floor(Math.random() * 100)),
        content: Array.from({length: 4}, () => Math.floor(Math.random() * 20)),
        engagement: Array.from({length: 5}, () => Math.floor(Math.random() * 50)),
        stats: {
            totalUsers: Math.floor(Math.random() * 1000),
            activeUsers: Math.floor(Math.random() * 500),
            newContent: Math.floor(Math.random() * 50),
            engagement: Math.floor(Math.random() * 100) + '%'
        }
    }
}

// Mise à jour des statistiques
function updateStats(stats) {
    document.getElementById('totalUsers').textContent = stats.totalUsers
    document.getElementById('activeUsers').textContent = stats.activeUsers
    document.getElementById('newContent').textContent = stats.newContent
    document.getElementById('engagement').textContent = stats.engagement
}

// Initialisation
let charts
