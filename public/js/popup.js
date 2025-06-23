// Fonction pour créer et afficher une pop-up
function showPopup(title, type) {
    // Créer l'élément pop-up
    const popup = document.createElement('div');
    popup.className = 'popup-overlay';
    
    // Sélectionner le bon formulaire caché
    let formId = '';
    if (type === 'quiz') formId = 'form-quiz';
    if (type === 'module') formId = 'form-module';
    if (type === 'exploration') formId = 'form-exploration';
    const formContainer = document.getElementById(formId);
    let formClone = null;
    if (formContainer) {
        formClone = formContainer.firstElementChild.cloneNode(true);
        formClone.style.display = '';
    }

    // Contenu de la pop-up
    popup.innerHTML = `
        <div class="popup-content">
            <div class="popup-header">
                <h3>${title}</h3>
                <button class="close-popup">&times;</button>
            </div>
            <div class="popup-body" id="popup-body"></div>
        </div>
    `;

    // Ajouter la pop-up au body
    document.body.appendChild(popup);

    // Insérer le formulaire cloné dans la pop-up
    if (formClone) {
        popup.querySelector('#popup-body').appendChild(formClone);
    }

    // Gérer la fermeture de la pop-up
    const closeBtn = popup.querySelector('.close-popup');
    const cancelBtn = popup.querySelector('.btn-cancel');
    const form = popup.querySelector('form');

    const closePopup = () => {
        popup.remove();
    };

    closeBtn.addEventListener('click', closePopup);
    if (cancelBtn) cancelBtn.addEventListener('click', closePopup);

    // (Optionnel) Gérer la soumission du formulaire ici si besoin
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