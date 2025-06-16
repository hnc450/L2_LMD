// Gestion des utilisateurs
document.addEventListener("DOMContentLoaded", () => {
  // Vérifier l'authentification
  if (localStorage.getItem("adminLoggedIn") !== "true") {
    window.location.href = "login.html"
    return
  }

  // Données fictives des utilisateurs
  const usersData = [
    {
      id: 1,
      name: "Marie Dubois",
      email: "marie.dubois@email.com",
      avatar: "../img/avatar1.png",
      status: "active",
      role: "premium",
      points: 15420,
      gamesPlayed: 342,
      successRate: 89.2,
      registrationDate: "2024-01-15",
      lastActivity: "2024-03-15T14:30:00",
      age: "12-14",
    },
    {
      id: 2,
      name: "Thomas Martin",
      email: "thomas.martin@email.com",
      avatar: "../img/avatar2.png",
      status: "active",
      role: "user",
      points: 14850,
      gamesPlayed: 298,
      successRate: 85.7,
      registrationDate: "2024-01-20",
      lastActivity: "2024-03-15T13:15:00",
      age: "9-11",
    },
    {
      id: 3,
      name: "Sophie Laurent",
      email: "sophie.laurent@email.com",
      avatar: "../img/avatar3.png",
      status: "inactive",
      role: "user",
      points: 13920,
      gamesPlayed: 267,
      successRate: 78.3,
      registrationDate: "2024-02-01",
      lastActivity: "2024-03-10T09:45:00",
      age: "15+",
    },
    {
      id: 4,
      name: "Lucas Petit",
      email: "lucas.petit@email.com",
      avatar: "../img/avatar4.png",
      status: "active",
      role: "moderator",
      points: 12750,
      gamesPlayed: 234,
      successRate: 82.1,
      registrationDate: "2024-02-10",
      lastActivity: "2024-03-15T11:20:00",
      age: "6-8",
    },
    {
      id: 5,
      name: "Emma Rousseau",
      email: "emma.rousseau@email.com",
      avatar: "../img/avatar5.png",
      status: "active",
      role: "premium",
      points: 11680,
      gamesPlayed: 201,
      successRate: 86.4,
      registrationDate: "2024-02-15",
      lastActivity: "2024-03-15T12:45:00",
      age: "12-14",
    },
    {
      id: 6,
      name: "Antoine Moreau",
      email: "antoine.moreau@email.com",
      avatar: "../img/avatar.png",
      status: "banned",
      role: "user",
      points: 8420,
      gamesPlayed: 156,
      successRate: 65.2,
      registrationDate: "2024-03-01",
      lastActivity: "2024-03-12T16:30:00",
      age: "15+",
    },
  ]

  let currentPage = 1
  const itemsPerPage = 20
  let filteredUsers = [...usersData]

  // Initialiser la page
  initUsersPage()

  function initUsersPage() {
    // Charger les utilisateurs
    loadUsers()

    // Initialiser les filtres
    initFilters()

    // Initialiser la pagination
    initPagination()

    // Initialiser les actions
    initActions()

    // Gérer la déconnexion
    document.getElementById("logoutBtn").addEventListener("click", () => {
      if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
        localStorage.removeItem("adminLoggedIn")
        window.location.href = "login.html"
      }
    })
  }

  function loadUsers() {
    const tbody = document.getElementById("usersTableBody")
    tbody.innerHTML = ""

    const startIndex = (currentPage - 1) * itemsPerPage
    const endIndex = startIndex + itemsPerPage
    const usersToShow = filteredUsers.slice(startIndex, endIndex)

    usersToShow.forEach((user) => {
      const row = createUserRow(user)
      tbody.appendChild(row)
    })

    updatePaginationInfo()
  }

  function createUserRow(user) {
    const row = document.createElement("tr")
    row.innerHTML = `
            <td>
                <input type="checkbox" class="user-checkbox" data-user-id="${user.id}">
            </td>
            <td>
                <div class="user-info">
                    <img src="${user.avatar}" alt="Avatar">
                    <div>
                        <span class="user-name">${user.name}</span>
                        <span class="user-id">#${user.id}</span>
                    </div>
                </div>
            </td>
            <td>${user.email}</td>
            <td>
                <span class="badge ${getStatusClass(user.status)}">${getStatusText(user.status)}</span>
            </td>
            <td>
                <span class="badge ${getRoleClass(user.role)}">${getRoleText(user.role)}</span>
            </td>
            <td><strong>${user.points.toLocaleString()}</strong></td>
            <td>${formatDate(user.registrationDate)}</td>
            <td>${formatRelativeTime(user.lastActivity)}</td>
            <td>
                <div class="action-buttons">
                    <button class="btn-action-sm" onclick="viewUser(${user.id})" title="Voir détails">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn-action-sm" onclick="editUser(${user.id})" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-action-sm ${user.status === "banned" ? "btn-success" : "btn-danger"}" 
                            onclick="toggleUserStatus(${user.id})" 
                            title="${user.status === "banned" ? "Débannir" : "Bannir"}">
                        <i class="fas fa-${user.status === "banned" ? "unlock" : "ban"}"></i>
                    </button>
                </div>
            </td>
        `

    return row
  }

  function getStatusClass(status) {
    switch (status) {
      case "active":
        return "success"
      case "inactive":
        return "warning"
      case "banned":
        return "danger"
      default:
        return "secondary"
    }
  }

  function getStatusText(status) {
    switch (status) {
      case "active":
        return "Actif"
      case "inactive":
        return "Inactif"
      case "banned":
        return "Banni"
      default:
        return status
    }
  }

  function getRoleClass(role) {
    switch (role) {
      case "premium":
        return "premium"
      case "moderator":
        return "moderator"
      case "user":
        return "secondary"
      default:
        return "secondary"
    }
  }

  function getRoleText(role) {
    switch (role) {
      case "premium":
        return "Premium"
      case "moderator":
        return "Modérateur"
      case "user":
        return "Utilisateur"
      default:
        return role
    }
  }

  function formatDate(dateString) {
    const date = new Date(dateString)
    return date.toLocaleDateString("fr-FR")
  }

  function formatRelativeTime(dateString) {
    const date = new Date(dateString)
    const now = new Date()
    const diffInHours = Math.floor((now - date) / (1000 * 60 * 60))

    if (diffInHours < 1) return "À l'instant"
    if (diffInHours < 24) return `Il y a ${diffInHours}h`

    const diffInDays = Math.floor(diffInHours / 24)
    if (diffInDays < 7) return `Il y a ${diffInDays}j`

    return formatDate(dateString)
  }

  function initFilters() {
    const searchInput = document.getElementById("userSearch")
    const statusFilter = document.getElementById("statusFilter")
    const roleFilter = document.getElementById("roleFilter")
    const ageFilter = document.getElementById("ageFilter")

    searchInput.addEventListener("input", applyFilters)
    statusFilter.addEventListener("change", applyFilters)
    roleFilter.addEventListener("change", applyFilters)
    ageFilter.addEventListener("change", applyFilters)
  }

  function applyFilters() {
    const searchTerm = document.getElementById("userSearch").value.toLowerCase()
    const statusFilter = document.getElementById("statusFilter").value
    const roleFilter = document.getElementById("roleFilter").value
    const ageFilter = document.getElementById("ageFilter").value

    filteredUsers = usersData.filter((user) => {
      const matchesSearch =
        user.name.toLowerCase().includes(searchTerm) || user.email.toLowerCase().includes(searchTerm)
      const matchesStatus = statusFilter === "all" || user.status === statusFilter
      const matchesRole = roleFilter === "all" || user.role === roleFilter
      const matchesAge = ageFilter === "all" || user.age === ageFilter

      return matchesSearch && matchesStatus && matchesRole && matchesAge
    })

    currentPage = 1
    loadUsers()
    updatePagination()
  }

  function initPagination() {
    document.getElementById("prevPage").addEventListener("click", () => {
      if (currentPage > 1) {
        currentPage--
        loadUsers()
        updatePagination()
      }
    })

    document.getElementById("nextPage").addEventListener("click", () => {
      const totalPages = Math.ceil(filteredUsers.length / itemsPerPage)
      if (currentPage < totalPages) {
        currentPage++
        loadUsers()
        updatePagination()
      }
    })
  }

  function updatePagination() {
    const totalPages = Math.ceil(filteredUsers.length / itemsPerPage)
    const prevBtn = document.getElementById("prevPage")
    const nextBtn = document.getElementById("nextPage")

    prevBtn.disabled = currentPage === 1
    nextBtn.disabled = currentPage === totalPages

    // Générer les numéros de page
    const pageNumbers = document.getElementById("pageNumbers")
    pageNumbers.innerHTML = ""

    for (let i = 1; i <= Math.min(totalPages, 5); i++) {
      const pageBtn = document.createElement("button")
      pageBtn.className = `btn-page ${i === currentPage ? "active" : ""}`
      pageBtn.textContent = i
      pageBtn.addEventListener("click", () => {
        currentPage = i
        loadUsers()
        updatePagination()
      })
      pageNumbers.appendChild(pageBtn)
    }
  }

  function updatePaginationInfo() {
    const startItem = (currentPage - 1) * itemsPerPage + 1
    const endItem = Math.min(currentPage * itemsPerPage, filteredUsers.length)
    const totalItems = filteredUsers.length

    document.getElementById("startItem").textContent = startItem
    document.getElementById("endItem").textContent = endItem
    document.getElementById("totalItems").textContent = totalItems
  }

  function initActions() {
    // Sélection de tous les utilisateurs
    document.getElementById("selectAll").addEventListener("change", function () {
      const checkboxes = document.querySelectorAll(".user-checkbox")
      checkboxes.forEach((checkbox) => {
        checkbox.checked = this.checked
      })
    })

    // Exporter les utilisateurs
    document.getElementById("exportUsers").addEventListener("click", () => {
      exportUsersToCSV()
    })

    // Ajouter un utilisateur
    document.getElementById("addUser").addEventListener("click", () => {
      showAddUserModal()
    })

    // Actions groupées
    document.getElementById("bulkActions").addEventListener("click", () => {
      showBulkActionsMenu()
    })
  }

  function exportUsersToCSV() {
    const headers = ["ID", "Nom", "Email", "Statut", "Rôle", "Points", "Inscription", "Dernière activité"]
    const csvContent = [
      headers.join(","),
      ...filteredUsers.map((user) =>
        [
          user.id,
          `"${user.name}"`,
          user.email,
          user.status,
          user.role,
          user.points,
          user.registrationDate,
          user.lastActivity,
        ].join(","),
      ),
    ].join("\n")

    const blob = new Blob([csvContent], { type: "text/csv" })
    const url = window.URL.createObjectURL(blob)
    const a = document.createElement("a")
    a.href = url
    a.download = `utilisateurs_${new Date().toISOString().split("T")[0]}.csv`
    a.click()
    window.URL.revokeObjectURL(url)

    showNotification("Export réalisé avec succès", "success")
  }

  // Fonctions globales pour les actions sur les utilisateurs
  window.viewUser = (userId) => {
    const user = usersData.find((u) => u.id === userId)
    if (user) {
      showUserModal(user)
    }
  }

  window.editUser = (userId) => {
    const user = usersData.find((u) => u.id === userId)
    if (user) {
      showEditUserModal(user)
    }
  }

  window.toggleUserStatus = (userId) => {
    const user = usersData.find((u) => u.id === userId)
    if (user) {
      const action = user.status === "banned" ? "débannir" : "bannir"
      if (confirm(`Êtes-vous sûr de vouloir ${action} cet utilisateur ?`)) {
        user.status = user.status === "banned" ? "active" : "banned"
        loadUsers()
        showNotification(`Utilisateur ${action === "débannir" ? "débanni" : "banni"} avec succès`, "success")
      }
    }
  }

  function showUserModal(user) {
    const modal = document.getElementById("userModal")
    const modalBody = document.getElementById("userModalBody")

    modalBody.innerHTML = `
            <div class="user-details">
                <div class="user-header">
                    <img src="${user.avatar}" alt="Avatar" class="user-avatar-large">
                    <div class="user-info-large">
                        <h3>${user.name}</h3>
                        <p>${user.email}</p>
                        <div class="user-badges">
                            <span class="badge ${getStatusClass(user.status)}">${getStatusText(user.status)}</span>
                            <span class="badge ${getRoleClass(user.role)}">${getRoleText(user.role)}</span>
                        </div>
                    </div>
                </div>
                
                <div class="user-stats-grid">
                    <div class="stat-item">
                        <i class="fas fa-star"></i>
                        <div>
                            <span class="stat-label">Points</span>
                            <span class="stat-value">${user.points.toLocaleString()}</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-gamepad"></i>
                        <div>
                            <span class="stat-label">Parties jouées</span>
                            <span class="stat-value">${user.gamesPlayed}</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-percentage"></i>
                        <div>
                            <span class="stat-label">Taux de réussite</span>
                            <span class="stat-value">${user.successRate}%</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-calendar"></i>
                        <div>
                            <span class="stat-label">Inscription</span>
                            <span class="stat-value">${formatDate(user.registrationDate)}</span>
                        </div>
                    </div>
                </div>
                
                <div class="user-actions">
                    <button class="btn-primary" onclick="editUser(${user.id})">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <button class="btn-secondary" onclick="sendMessage(${user.id})">
                        <i class="fas fa-envelope"></i> Envoyer un message
                    </button>
                    <button class="btn-danger" onclick="toggleUserStatus(${user.id})">
                        <i class="fas fa-ban"></i> ${user.status === "banned" ? "Débannir" : "Bannir"}
                    </button>
                </div>
            </div>
        `

    modal.style.display = "flex"

    // Fermer le modal
    document.getElementById("closeModal").onclick = () => {
      modal.style.display = "none"
    }

    modal.onclick = (e) => {
      if (e.target === modal) {
        modal.style.display = "none"
      }
    }
  }

  function showAddUserModal() {
    alert("showAddUserModal function called")
  }

  function showBulkActionsMenu() {
    alert("showBulkActionsMenu function called")
  }

  function showEditUserModal(user) {
    alert("showEditUserModal function called for user " + user.name)
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

    setTimeout(() => {
      notification.style.transform = "translateX(0)"
    }, 100)

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
