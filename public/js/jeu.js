class GamesFilter {
    constructor() {
        this.games = [];
        this.activeFilters = {
            category: 'Tous',
            age: 'Tous',
            difficulty: 'Tous'
        };
        
        this.init();
    }

    init() {
        this.collectGameData();
        this.bindFilterEvents();
    }

    collectGameData() {
        const gameCards = document.querySelectorAll('.game-card');
        this.games = Array.from(gameCards).map(card => {
            const title = card.querySelector('h3').textContent;
            const age = card.querySelector('.game-badge').textContent;
            const category = this.extractCategory(title);
            const difficulty = this.extractDifficulty(card);
            
            return {
                element: card,
                title: title,
                age: age,
                category: category,
                difficulty: difficulty
            };
        });
    }

    extractCategory(title) {
        if (title.includes('Géographie')) return 'Géographie';
        if (title.includes('Histoire')) return 'Histoire';
        if (title.includes('Sciences')) return 'Sciences';
        if (title.includes('Culture')) return 'Culture';
        return 'Autre';
    }

    extractDifficulty(card) {
        const age = card.querySelector('.game-badge').textContent;
        if (age === '6-8 ans') return 'Facile';
        if (age === '9-11 ans') return 'Facile';
        if (age === '12-14 ans') return 'Moyen';
        if (age === '15+ ans') return 'Difficile';
        return 'Facile';
    }

    bindFilterEvents() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                this.handleFilterClick(button);
            });
        });
    }

    handleFilterClick(clickedButton) {
        const filterGroup = clickedButton.closest('.filter-group');
        const filterType = this.getFilterType(filterGroup);
        const filterValue = clickedButton.textContent;

        // Mettre à jour l'état actif des boutons
        filterGroup.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        clickedButton.classList.add('active');

        // Mettre à jour les filtres actifs
        this.activeFilters[filterType] = filterValue;

        // Appliquer les filtres
        this.applyFilters();
    }

    getFilterType(filterGroup) {
        const label = filterGroup.querySelector('label').textContent.toLowerCase();
        if (label.includes('catégorie')) return 'category';
        if (label.includes('âge')) return 'age';
        if (label.includes('difficulté')) return 'difficulty';
        return '';
    }

    applyFilters() {
        let visibleCount = 0;

        this.games.forEach(game => {
            const shouldShow = this.shouldShowGame(game);
            
            if (shouldShow) {
                game.element.style.display = 'block';
                game.element.classList.add('fade-in');
                visibleCount++;
            } else {
                game.element.style.display = 'none';
                game.element.classList.remove('fade-in');
            }
        });

        this.updateResultsCount(visibleCount);
        this.animateResults();
    }

    shouldShowGame(game) {
        const categoryMatch = this.activeFilters.category === 'Tous' || 
                             game.category === this.activeFilters.category;
        
        const ageMatch = this.activeFilters.age === 'Tous' || 
                        game.age === this.activeFilters.age;
        
        const difficultyMatch = this.activeFilters.difficulty === 'Tous' || 
                               game.difficulty === this.activeFilters.difficulty;

        return categoryMatch && ageMatch && difficultyMatch;
    }

    updateResultsCount(count) {
        let resultsInfo = document.querySelector('.results-info');
        
        if (!resultsInfo) {
            resultsInfo = document.createElement('div');
            resultsInfo.className = 'results-info';
            document.querySelector('.games-grid').insertAdjacentElement('beforebegin', resultsInfo);
        }

        const totalGames = this.games.length;
        resultsInfo.innerHTML = `
            <span class="results-count">
                <i class="fas fa-gamepad"></i>
                ${count} jeu${count !== 1 ? 'x' : ''} trouvé${count !== 1 ? 's' : ''} sur ${totalGames}
            </span>
        `;

        if (count === 0) {
            this.showNoResultsMessage();
        } else {
            this.hideNoResultsMessage();
        }
    }

    showNoResultsMessage() {
        let noResults = document.querySelector('.no-results');
        
        if (!noResults) {
            noResults = document.createElement('div');
            noResults.className = 'no-results';
            noResults.innerHTML = `
                <div class="no-results-content">
                    <i class="fas fa-search"></i>
                    <h3>Aucun jeu trouvé</h3>
                    <p>Essayez de modifier vos critères de recherche</p>
                    <button class="btn-reset-filters">Réinitialiser les filtres</button>
                </div>
            `;
            document.querySelector('.games-grid').appendChild(noResults);

            // Ajouter l'événement pour réinitialiser
            noResults.querySelector('.btn-reset-filters').addEventListener('click', () => {
                this.resetAllFilters();
            });
        }

        noResults.style.display = 'flex';
    }

    hideNoResultsMessage() {
        const noResults = document.querySelector('.no-results');
        if (noResults) {
            noResults.style.display = 'none';
        }
    }

    resetAllFilters() {
        // Réinitialiser les filtres actifs
        this.activeFilters = {
            category: 'Tous',
            age: 'Tous',
            difficulty: 'Tous'
        };

        // Réinitialiser l'interface
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.textContent === 'Tous') {
                btn.classList.add('active');
            }
        });

        // Réappliquer les filtres
        this.applyFilters();
    }

    animateResults() {
        const visibleCards = document.querySelectorAll('.game-card[style*="block"]');
        
        visibleCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.3s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        });
    }

    // Méthode pour ajouter un nouveau jeu dynamiquement
    addGame(gameData) {
        this.games.push(gameData);
        this.applyFilters();
    }

    // Méthode pour obtenir les statistiques des filtres
    getFilterStats() {
        const stats = {
            categories: {},
            ages: {},
            difficulties: {}
        };

        this.games.forEach(game => {
            stats.categories[game.category] = (stats.categories[game.category] || 0) + 1;
            stats.ages[game.age] = (stats.ages[game.age] || 0) + 1;
            stats.difficulties[game.difficulty] = (stats.difficulties[game.difficulty] || 0) + 1;
        });

        return stats;
    }
}

// Initialiser le système de filtrage quand le DOM est chargé
document.addEventListener('DOMContentLoaded', () => {
    window.gamesFilter = new GamesFilter();
});
