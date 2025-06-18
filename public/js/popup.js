// Fonction pour créer et afficher une pop-up
function showPopup(title, type) {
    // Créer l'élément pop-up
    const popup = document.createElement('div');
    popup.className = 'popup-overlay';
    
    // Contenu de la pop-up
    popup.innerHTML = `
        <div class="popup-content">
            <div class="popup-header">
                <h3>${title}</h3>
                <button class="close-popup">&times;</button>
            </div>
            <div class="popup-body">
                <form id="contentForm" method="POST" action="/administration/add/${type}">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie</label>
                        <select id="category" required>
                            <option value="">Sélectionner une catégorie</option>
                            <option value="geography">Géographie</option>
                            <option value="history">Histoire</option>
                            <option value="science">Sciences</option>
                            <option value="culture">Culture</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="level">Niveau</label>
                        <select id="level" required>
                            <option value="">Sélectionner un niveau</option>
                            <option value="6-8">6-8 ans</option>
                            <option value="9-11">9-11 ans</option>
                            <option value="12-14">12-14 ans</option>
                            <option value="15+">15+ ans</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-cancel">Annuler</button>
                        <button type="submit" class="btn-save">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    `;

    // Ajouter la pop-up au body
    document.body.appendChild(popup);

    // Gérer la fermeture de la pop-up
    const closeBtn = popup.querySelector('.close-popup');
    const cancelBtn = popup.querySelector('.btn-cancel');
    const form = popup.querySelector('#contentForm');

    const closePopup = () => {
        popup.remove();
    };

    closeBtn.addEventListener('click', closePopup);
    cancelBtn.addEventListener('click', closePopup);

    // Gérer la soumission du formulaire
    // form.addEventListener('submit', (e) => {
    //     e.preventDefault();
    //     const formData = {
    //         title: document.getElementById('title').value,
    //         description: document.getElementById('description').value,
    //         category: document.getElementById('category').value,
    //         level: document.getElementById('level').value,
    //         type: type
    //     };
        
    //     // Ici, vous pouvez ajouter la logique pour sauvegarder les données
    //     console.log('Données du formulaire:', formData);
        
    //     // Fermer la pop-up après l'enregistrement
    //     closePopup();
    // });
}

// Ajouter les écouteurs d'événements aux boutons
document.addEventListener('DOMContentLoaded', () => {
    // Bouton Nouveau Quiz
    const newQuizBtn = document.querySelector('.action-btn.primary');
    if (newQuizBtn) {
        newQuizBtn.addEventListener('click', () => showPopup('Nouveau Quiz', 'quiz'));
    }

    // Bouton Nouveau Module
    const newModuleBtn = document.querySelector('.action-btn.secondary');
    if (newModuleBtn) {
        newModuleBtn.addEventListener('click', () => showPopup('Nouveau Module', 'module'));
    }

    // Bouton Nouvelle Exploration
    const newExplorationBtn = document.querySelector('.action-btn.tertiary');
    if (newExplorationBtn) {
        newExplorationBtn.addEventListener('click', () => showPopup('Nouvelle Exploration', 'exploration'));
    }
}); 