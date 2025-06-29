let categories = [];

function fetchCategories() {
    fetch('http://localhost:8000/api/categories')
        .then(response => response.json())
        .then(data => {
            categories = data; // Supposons que data est un tableau d'objets {id, nom}
            updateCategoryTabs();
            updateCategoryCount();
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des catégories:', error);
        });
}

function updateCategoryTabs() {
    const tabsContainer = document.querySelector('.filter-tabs-container'); // à adapter selon ta structure HTML
    if (!tabsContainer) return;

    tabsContainer.innerHTML = ''; // Vide les anciens onglets

    // Onglet "Tous"
    const allTab = document.createElement('button');
    allTab.className = 'filter-tab active';
    allTab.setAttribute('data-category', 'all');
    allTab.textContent = 'Tous';
    tabsContainer.appendChild(allTab);

    // Onglets pour chaque catégorie
    categories.forEach(cat => {
        const tab = document.createElement('button');
        tab.className = 'filter-tab';
        tab.setAttribute('data-category', cat.id);
        tab.textContent = cat.nom;
        tabsContainer.appendChild(tab);
    });

    // Re-attacher les listeners
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            applyAllFilters();
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Éléments du DOM
    const searchInput = document.querySelector('.search-filter input');
    const explorationCards = document.querySelectorAll('.exploration-card');

    // Fonction pour filtrer par catégorie
    function filterByCategory(category) {
        explorationCards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            if (category === 'all' || cardCategory === category) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.3s ease-in';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Fonction pour filtrer par recherche
    function filterBySearch(searchTerm) {
        const term = searchTerm.toLowerCase().trim();
        explorationCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();
            const category = card.querySelector('.exploration-badge').textContent.toLowerCase();
            const matches = title.includes(term) || 
                          description.includes(term) || 
                          category.includes(term);
            if (matches || term === '') {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.3s ease-in';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Fonction pour filtrer par catégorie ET recherche
    function applyAllFilters() {
        const activeTab = document.querySelector('.filter-tab.active');
        const activeCategory = activeTab ? activeTab.getAttribute('data-category') : 'all';
        const searchTerm = searchInput.value.toLowerCase().trim();

        explorationCards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();
            const category = card.querySelector('.exploration-badge').textContent.toLowerCase();
            // Vérifier la catégorie
            const categoryMatch = activeCategory === 'all' || cardCategory === activeCategory;
            // Vérifier la recherche
            const searchMatch = searchTerm === '' || 
                              title.includes(searchTerm) || 
                              description.includes(searchTerm) || 
                              category.includes(searchTerm);
            if (categoryMatch && searchMatch) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.3s ease-in';
            } else {
                card.style.display = 'none';
            }
        });
        // Afficher un message si aucun résultat
        showNoResultsMessage();
    }

    // Fonction pour afficher un message "Aucun résultat"
    function showNoResultsMessage() {
        const visibleCards = Array.from(explorationCards).filter(card => 
            card.style.display !== 'none'
        );
        // Supprimer le message existant s'il y en a un
        const existingMessage = document.querySelector('.no-results-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        // Afficher le message si aucune carte n'est visible
        if (visibleCards.length === 0) {
            const noResultsMessage = document.createElement('div');
            noResultsMessage.className = 'no-results-message';
            noResultsMessage.innerHTML = `
                <div style="text-align: center; padding: 2rem; color: #666;">
                    <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <h3>Aucune exploration trouvée</h3>
                    <p>Essayez de modifier vos critères de recherche</p>
                </div>
            `;
            document.querySelector('.explorations-grid').appendChild(noResultsMessage);
        }
    }

    // Gestionnaire d'événements pour la recherche
    searchInput.addEventListener('input', function() {
        applyAllFilters();
    });
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            applyAllFilters();
        }
    });

    // Fonction pour compter les explorations par catégorie
    function updateCategoryCount() {
        if (categories.length === 0) return;
        categories.forEach(cat => {
            const tab = document.querySelector(`[data-category="${cat.id}"]`);
            if (tab) {
                const count = Array.from(explorationCards).filter(card => card.getAttribute('data-category') === cat.id).length;
                // tab.innerHTML = `${cat.nom} <span class="count">(${count})</span>`;
            }
        });
    }

    // Animation d'entrée pour les cartes
    function animateCards() {
        explorationCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.3s ease-in-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }
    animateCards();
    fetchCategories();

    const filterTabs = document.querySelectorAll('.filter-tab');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // Retirer la classe active de tous les boutons
            filterTabs.forEach(t => t.classList.remove('active'));
            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');

            const category = this.getAttribute('data-category');

            explorationCards.forEach(card => {
                // Si "all" est sélectionné, tout afficher
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
