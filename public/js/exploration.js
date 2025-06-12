document.addEventListener('DOMContentLoaded', function() {
    // Éléments du DOM
    const filterTabs = document.querySelectorAll('.filter-tab');
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
        const activeCategory = activeTab.getAttribute('data-category');
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

    // Gestionnaire d'événements pour les onglets de filtre
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Retirer la classe active de tous les onglets
            filterTabs.forEach(t => t.classList.remove('active'));
            
            // Ajouter la classe active à l'onglet cliqué
            this.classList.add('active');
            
            // Appliquer tous les filtres
            applyAllFilters();
        });
    });

    // Gestionnaire d'événements pour la recherche
    searchInput.addEventListener('input', function() {
        applyAllFilters();
    });

    // Gestionnaire d'événements pour la recherche en temps réel (optionnel)
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            applyAllFilters();
        }
    });

    // Fonction pour compter les explorations par catégorie
    function updateCategoryCount() {
        const categories = ['all', 'geography', 'history', 'science', 'culture'];
        
        categories.forEach(category => {
            const tab = document.querySelector(`[data-category="${category}"]`);
            if (tab) {
                let count;
                if (category === 'all') {
                    count = explorationCards.length;
                } else {
                    count = document.querySelectorAll(`[data-category="${category}"]`).length;
                }
                
                // Ajouter le compteur au texte de l'onglet (optionnel)
                const tabText = tab.textContent.replace(/\(\d+\)/, '').trim();
                // tab.innerHTML = `${tabText} <span class="count">(${count})</span>`;
            }
        });
    }

    // Initialiser les compteurs (optionnel)
    // updateCategoryCount();

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

    // Lancer l'animation au chargement
    animateCards();
});
