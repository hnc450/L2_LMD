<!-- POPUP MODALE DE MODIFICATION DE QUIZ -->
<div id="editQuizModal" style="display:none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); z-index: 1000; display: flex; align-items: center; justify-content: center;">
  <div class="modal-content" style="background: var(--bg-color, #fff); border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 500px; width: 100%; margin: auto; padding: 2rem 1.5rem; position: relative;">
    <span class="close-btn" onclick="closeEditQuizModal()" style="position: absolute; top: 1rem; right: 1rem; font-size: 1.5rem; cursor: pointer;">&times;</span>
    <h2 style="text-align:center; color: var(--text-color, #222); margin-bottom: 1.5rem;">Modifier le jeu</h2>
    <form id="editQuizForm">
      <input type="hidden" name="id_jeu" id="edit-quiz-id">
      <div class="form-group">
        <label for="edit-title-quiz">Titre</label>
        <input type="text" id="edit-title-quiz" name="titre" required>
      </div>
      <div class="form-group">
        <label for="edit-slug-quiz">Image ou Lien Image</label>
        <input type="text" id="edit-slug-quiz" name="slug_img" required>
      </div>
      <div class="form-group">
        <label for="edit-duration-quiz">Durée</label>
        <input type="text" id="edit-duration-quiz" name="duration" required>
      </div>
      <div class="form-group">
        <label for="edit-description-quiz">Description</label>
        <textarea id="edit-description-quiz" name="description" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="edit-category-quiz">Catégorie</label>
        <select id="edit-category-quiz" name="category" required></select>
      </div>
      <div class="form-group">
        <label for="edit-age-quiz">Tranche d'âge</label>
        <select id="edit-age-quiz" name="age" required>
          <option value="6-8">6-8 ans</option>
          <option value="9-11">9-11 ans</option>
          <option value="12-14">12-14 ans</option>
          <option value="15+">15+ ans</option>
        </select>
      </div>
      <div class="form-actions" style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
        <button type="button" class="btn-cancel" onclick="closeEditQuizModal()">Annuler</button>
        <button type="submit" class="btn-save">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

<!-- POPUP MODALE DE MODIFICATION DE MODULE -->
<div id="editModuleModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditModuleModal()">&times;</span>
        <h2>Modifier le Module</h2>
        <form id="editModuleForm">
            <input type="hidden" name="id_module" id="edit-module-id">
            <div class="form-group">
                <label for="edit-title-module">Titre</label>
                <input type="text" id="edit-title-module" name="titre" required>
            </div>
            <div class="form-group">
                <label for="edit-description-module">Description</label>
                <textarea id="edit-description-module" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="edit-category-module">Catégorie</label>
                <select id="edit-category-module" name="categorie" required></select>
            </div>
            <div class="form-group">
                <label for="edit-level-module">Niveau</label>
                <select id="edit-level-module" name="niveau" required>
                    <option value="6-8">6-8 ans</option>
                    <option value="9-11">9-11 ans</option>
                    <option value="12-14">12-14 ans</option>
                    <option value="15+">15+ ans</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="closeEditModuleModal()">Annuler</button>
                <button type="submit" class="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- POPUP MODALE DE MODIFICATION D'EXPLORATION -->
<div id="editExplorationModal" style="display:none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); z-index: 1000; display: flex; align-items: center; justify-content: center;">
  <div class="modal-content" style="background: var(--bg-color, #fff); border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 500px; width: 100%; margin: auto; padding: 2rem 1.5rem; position: relative;">
    <span class="close-btn" onclick="closeEditExplorationModal()" style="position: absolute; top: 1rem; right: 1rem; font-size: 1.5rem; cursor: pointer;">&times;</span>
    <h2 style="text-align:center; color: var(--text-color, #222); margin-bottom: 1.5rem;">Modifier l'Exploration</h2>
    <form id="editExplorationForm" action="/administration/exploration/1" method="POST">
      <input type="hidden" name="id_exploration" id="edit-exploration-id">
      <div class="form-group">
        <label for="edit-title-exploration">Titre</label>
        <input type="text" id="edit-title-exploration" name="titre" required>
      </div>
      <div class="form-group">
        <label for="edit-slug-exploration">Image (slug ou chemin)</label>
        <input type="text" id="edit-slug-exploration" name="slug" required>
      </div>
      <div class="form-group">
        <label for="edit-description-exploration">Description</label>
        <textarea id="edit-description-exploration" name="description" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="edit-contenu-exploration">Contenu</label>
        <textarea id="edit-contenu-exploration" name="contenu" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="edit-category-exploration">Catégorie</label>
        <select id="edit-category-exploration" name="categorie" required></select>
      </div>
      <div class="form-actions" style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
        <button type="button" class="btn-cancel" onclick="closeEditExplorationModal()">Annuler</button>
        <button type="submit" class="btn-save">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

<script>
// Ouvre la popup et pré-remplit les champs
document.querySelectorAll('.btn-icon.edit[data-type="quiz"]').forEach(btn => {
    btn.addEventListener('click', function() {
        const quizId = this.getAttribute('data-id');
        fetch(`/api/game/${quizId}`)
            .then(res => res.json())
            .then(quiz => {
              
                document.getElementById('edit-quiz-id').value = quiz[0].id_jeu;
                document.getElementById('edit-title-quiz').value = quiz[0].titre;
                document.getElementById('edit-slug-quiz').value = quiz[0].slug_img;
                document.getElementById('edit-duration-quiz').value = quiz[0].duration;
                document.getElementById('edit-description-quiz').value = quiz[0].description;
              
                document.getElementById('edit-age-quiz').value = quiz[0].age;

                // Remplir les catégories
                fetch('/api/categories')
                    .then(res => res.json())
                    .then(categories => {
                        const select = document.getElementById('edit-category-quiz');
                        select.innerHTML = '';
                        categories.forEach(cat => {
                            const opt = document.createElement('option');
                            opt.value = cat.id_categorie;
                            opt.textContent = cat.categorie;
                            if (cat.categorie === quiz.categorie || cat.id_categorie == quiz.id_categorie) {
                                opt.selected = true;
                            }
                            select.appendChild(opt);
                        });
                    });

                document.getElementById('editQuizModal').style.display = 'block';
            });
    });
});

function closeEditQuizModal() {
    document.getElementById('editQuizModal').style.display = 'none';
}

// Soumission du formulaire de modification
document.getElementById('editQuizForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('edit-quiz-id').value;
    const data = Object.fromEntries(new FormData(this).entries());
    fetch(`/administration/quiz/${id}`, {
        method: 'PUT',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })
    .then(res => {
        if (res.ok) {
            location.reload();
        } else {
            alert('Erreur lors de la modification');
        }
    });
});

// --- Quiz déjà présent ---
// Ouvre la popup et pré-remplit les champs pour les modules

document.querySelectorAll('.btn-icon.edit[data-type="module"]').forEach(btn => {
    btn.addEventListener('click', function() {
        const moduleId = this.getAttribute('data-id');
        fetch(`/api/module/${moduleId}`)
            .then(res => res.json())
            .then(module => {
                document.getElementById('edit-module-id').value = module.id_module;
                document.getElementById('edit-title-module').value = module.titre;
                document.getElementById('edit-description-module').value = module.description;
                document.getElementById('edit-level-module').value = module.niveau;
                // Remplir les catégories
                fetch('/api/categories')
                    .then(res => res.json())
                    .then(categories => {
                        const select = document.getElementById('edit-category-module');
                        select.innerHTML = '';
                        categories.forEach(cat => {
                            const opt = document.createElement('option');
                            opt.value = cat.id_categorie;
                            opt.textContent = cat.categorie;
                            if (cat.categorie === module.categorie || cat.id_categorie == module.id_categorie) {
                                opt.selected = true;
                            }
                            select.appendChild(opt);
                        });
                    });
                document.getElementById('editModuleModal').style.display = 'block';
            });
    });
});

function closeEditModuleModal() {
    document.getElementById('editModuleModal').style.display = 'none';
}

document.getElementById('editModuleForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('edit-module-id').value;
    const data = Object.fromEntries(new FormData(this).entries());
    fetch(`/administration/module/${id}`, {
        method: 'PUT',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })
    .then(res => {
        if (res.ok) {
            location.reload();
        } else {
            alert('Erreur lors de la modification');
        }
    });
});

// --- Exploration ---
document.querySelectorAll('.btn-small.edit[data-type="exploration"]').forEach(btn => {
    btn.addEventListener('click', function() {
        const explorationId = this.getAttribute('data-id');
        fetch(`/api/exploration/${explorationId}`)
            .then(res => res.json())
            .then(exploration => {
                console.log(exploration);
                document.getElementById('edit-exploration-id').value = exploration[0].id_exploration;
                document.getElementById('edit-title-exploration').value = exploration[0].titre_exploration;
                document.getElementById('edit-slug-exploration').value = exploration[0].slug_exploration;
                document.getElementById('edit-description-exploration').value = exploration[0].description_exploration;
                document.getElementById('edit-contenu-exploration').value = exploration[0].contenu_exploration;
                // Remplir les catégories
                fetch('/api/categories')
                    .then(res => res.json())
                    .then(categories => {
                        const select = document.getElementById('edit-category-exploration');
                        select.innerHTML = '';
                        categories.forEach(cat => {
                            const opt = document.createElement('option');
                            opt.value = cat.id_categorie;
                            opt.textContent = cat.categorie;
                            if (cat.categorie === exploration.categorie || cat.id_categorie == exploration.categorie) {
                                opt.selected = true;
                            }
                            select.appendChild(opt);
                        });
                    });
                document.getElementById('editExplorationModal').style.display = 'block';
            });
    });
});

function closeEditExplorationModal() {
    document.getElementById('editExplorationModal').style.display = 'none';
}

// document.getElementById('editExplorationForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     const id = document.getElementById('edit-exploration-id').value;
//     const data = Object.fromEntries(new FormData(this).entries());
//     fetch(`/administration/exploration/${id}`, {
//         method: 'PUT',
//         headers: {'Content-Type': 'application/json'},
//         body: JSON.stringify(data)
//     })
//     .then(res => {
//         if (res.ok) {
//             location.reload();
//         } else {
//             alert('Erreur lors de la modification');
//         }
//     });
// });
</script>
