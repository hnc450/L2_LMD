<?php 
   use App\Models\JeuModel\JeuModel;
   $contenus = \App\Controllers\Admin\Admin::voir_toutes_les_informations();
   $modules = \App\Models\FactoryModel::Factory('module')->getAllModules();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Contenu - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        #edit-module-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0; top: 0; width: 100vw; height: 100vh;
  background: rgba(30, 32, 41, 0.55);
  justify-content: center;
  align-items: center;
}
#edit-module-modal.active, #edit-module-modal[style*='display: flex'] {
  display: flex !important;
}
#edit-module-modal .modal-content {
  background: #23242a;
  border-radius: 22px;
  max-width: 500px;
  width: 90vw;
  padding: 2rem 2rem 1.5rem 2rem;
  box-shadow: 0 12px 48px rgba(30,32,41,0.18), 0 2px 8px rgba(0,0,0,0.08);
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  
}
#edit-module-modal .close-btn {
  position: absolute;
  top: 18px;
  right: 28px;
  font-size: 2.2rem;
  color: #e74c3c;
  background: #fff;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  border: none;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}
#edit-module-modal .close-btn:hover {
  background: #ffeaea;
  color: #c0392b;
}

    #preview-modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(30, 32, 41, 0.55);
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
      transition: opacity 0.2s;
   }
   #preview-modal.active, #preview-modal[style*='display: block'] {
      display: flex !important;
   }
   #preview-modal .modal-content {
      background: #f9f9fb;
      border-radius: 22px;
      max-width: 650px;
      min-width: 350px;
      width: 90vw;
      min-height: 380px;
      max-height: 90vh;
      margin: auto;
      padding: 2.5rem 2.2rem 2rem 2.2rem;
      box-shadow: 0 12px 48px rgba(30,32,41,0.18), 0 2px 8px rgba(0,0,0,0.08);
      position: relative;
      animation: popupIn 0.33s cubic-bezier(.4,1.4,.6,1);
      display: flex;
      flex-direction: column;
      align-items: center;
   }
   #preview-modal .close-btn {
      position: absolute;
      top: 18px;
      right: 28px;
      font-size: 2.2rem;
      color: #e74c3c;
      background: #fff;
      border-radius: 50%;
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: none;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
   }
   #preview-modal .close-btn:hover {
      background: #ffeaea;
      color: #c0392b;
   }
   #preview-modal img {
      display: block;
      margin: 0 auto 1.2rem auto;
      border-radius: 14px;
      max-width: 96%;
      max-height: 220px;
      object-fit: cover;
      box-shadow: 0 2px 12px rgba(0,0,0,0.10);
      border: 2px solid #eaeaea;
   }
   #preview-modal h2 {
      text-align: center;
      margin-bottom: 0.7rem;
      font-size: 1.7rem;
      color: #222;
      font-weight: 600;
      letter-spacing: 0.01em;
   }
   #preview-modal p {
      margin: 0.4rem 0;
      color: #444;
      font-size: 1.08rem;
      width: 100%;
      text-align: left;
   }
   #preview-modal strong {
      color: #222;
      font-weight: 500;
   }
   #preview-modal .modal-content > p > span {
      color: #2d6cdf;
      font-weight: 500;
   }
   @keyframes popupIn {
      from { transform: translateY(40px) scale(0.95); opacity: 0; }
      to { transform: translateY(0) scale(1); opacity: 1; }
   }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar will be loaded here -->
        <div class="sidebar-container"></div>

        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header pour toutes les tailles d'écran -->
          <?php require __DIR__ . '/templates/navbar.php' ?>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Page Header -->
                <div class="page-header">
                    <h2><i class="fas fa-edit"></i> Gestion du Contenu</h2>
                    <p>Créez et gérez les quiz, modules et explorations</p>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <button class="action-btn primary">
                        <i class="fas fa-plus"></i>
                        Nouveau Jeu
                    </button>
                    <button class="action-btn secondary">
                        <i class="fas fa-book"></i>
                        Nouveau Module
                    </button>
                    <button class="action-btn tertiary">
                        <i class="fas fa-compass"></i>
                        Nouvelle Exploration
                    </button>
                    <button class="action-btn quaternary">
                        <i class="fas fa-upload"></i>
                        Importer Contenu
                    </button>
                </div>

                <!-- Content Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon quiz">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Jeu</h3>
                            <p class="stat-number"><?= $contenus['jeux'][0]['nombres_jeux']?></p>
                            <span class="stat-change positive">+12 cette semaine</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon module">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Modules</h3>
                            <p class="stat-number"> <?= $contenus['modules'][0]['nombre_modules']?> </p>
                            <span class="stat-change positive">+3 ce mois</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon exploration">
                            <i class="fas fa-compass"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Explorations</h3>
                            <p class="stat-number"><?=$contenus['explorations'][0]['nombres_explorations'] ?></p>
                            <span class="stat-change neutral">Aucun changement</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>En Attente</h3>
                            <p class="stat-number">0</p>
                            <span class="stat-change negative">Nécessite révision</span>
                        </div>
                    </div>
                </div>

                <!-- Content Management Tabs -->
                <div class="content-tabs">
                    <div class="tab-buttons">
                        <button class="tab-btn active" data-tab="quiz">Jeu</button>
                        <button class="tab-btn" data-tab="modules">Modules</button>
                        <button class="tab-btn" data-tab="explorations">Explorations</button>
                        <button class="tab-btn" data-tab="media">Médias</button>
                    </div>

                    <!-- Quiz Tab -->
                    <div class="tab-content active" id="quiz-tab">
                        <div class="content-header">
                            <div class="search-filter">
                                <input type="text" placeholder="Rechercher un quiz...">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="filter-options">
                                <select class="filter-select" id="category-quiz">
                                    <option>Toutes les catégories</option>
                                  
                                </select>
                                <select class="filter-select" id="level-quiz">
                                    <option value="">Tous les niveaux</option>
                                    <option value="6-8">6-8 ans</option>
                                    <option value="9-11">9-11 ans</option>
                                    <option value="12-14">12-14 ans</option>
                                    <option value="15+">15+ ans</option>
                                </select>
                            </div>
                        </div>

                        <div class="content-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Age</th>
                                        <!-- <th>Questions</th> -->
                                        <!-- <th>Statut</th> -->
                                        <th>Date de publication</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach(JeuModel::getAll() as $jeu): ?>
                                       
                                    <tr  data-age="<?= htmlspecialchars($jeu['age'] ?? '') ?>" data-category="<?= htmlspecialchars($jeu['id_categorie'] ?? '') ?>">
                                        <td>
                                            <div class="content-title">
                                                <img src="<?= htmlspecialchars($jeu['slug_img'] ?? 'img/placeholder.svg') ?>" alt="Quiz" class="content-thumb">
                                                <span><?= htmlspecialchars($jeu['titre'] ?? '') ?></span>
                                            </div>
                                        </td>
                                        <td><span class="category-badge"><?= htmlspecialchars($jeu['categorie'] ?? '') ?></span></td>
                                        <td><?= htmlspecialchars($jeu['age'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($jeu['date_post'] ?? '') ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-icon edit" title="Modifier" data-id="<?= htmlspecialchars($jeu['id_jeu'] ?? '') ?>" data-type="quiz">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-icon view" title="Prévisualiser" data-id="<?= htmlspecialchars($jeu['id_jeu'] ?? '') ?>" data-type="quiz">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-icon delete" title="Supprimer" data-id="<?= htmlspecialchars($jeu['id_jeu'] ?? '') ?>" data-type="quiz">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination">
                            <button class="pagination-btn" disabled>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <span class="pagination-info">Page 1 sur 5</span>
                            <button class="pagination-btn">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modules Tab -->
                    <div class="tab-content" id="modules-tab">
                        <div class="modules-grid">
                           <?php foreach($modules as $module): ?>
                            <div class="module-card-admin">
                                <div class="module-header" data-id="<?= $module['id'] ?>">
                                    <img src="<?= $module['slug_img']?>" alt="Module">
                                    <div class="module-status active">Actif</div>
                                </div>
                                <div class="module-content">
                                    <h3><?=  $module['titre'] ?></h3>
                                    <p><?=  $module['discribe_mod'] ?></p>
                                    <div class="module-meta">
                                        <span><i class="fas fa-users"></i> 0 utilisateurs</span>
                                        <span><i class="fas fa-star"></i> 0/5</span>
                                    </div>
                                    <div class="module-actions">
                                        <button class="btn-small edit" data-type="module">Modifier</button>
                                        <button class="btn-small view">Voir</button>
                                        <form action="/administration/module/<?= $module['id']?>" method="post">
                                            <button class="btn-icon delete">supprimer</button>
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>  
                          <?php endforeach?>

                        </div>
                    </div>

                    <!-- Explorations Tab -->
                    <div class="tab-content" id="explorations-tab">
                        <div class="modules-grid">
                            <?php foreach( \App\Models\Exploration\Exploration::getAll() as $exploration): ?>
                                <div class="module-card-admin">
                                    <div class="module-header">
                                        <img src="<?= htmlspecialchars($exploration['slug'] ?? 'img/placeholder.svg') ?>" alt="Exploration">
                                        <div class="module-status <?= ($exploration['statut'] ?? 'active') ?>">
                                            <?= ucfirst($exploration['statut'] ?? 'Actif') ?>
                                        </div>
                                    </div>
                                    <div class="module-content">
                                        <h3><?= htmlspecialchars($exploration['titre']) ?></h3>
                                        <p><?= htmlspecialchars($exploration['description'] ?? '') ?></p>
                                        <div class="module-meta">
                                            <span><i class="fas fa-tag"></i> <?= htmlspecialchars($exploration['categorie']) ?></span>
                                            <span><i class="fas fa-hashtag"></i> ID: <?= htmlspecialchars($exploration['id']) ?></span>
                                        </div>
                                        <div class="module-actions">
                                            <button class="btn-small edit" data-id="<?= htmlspecialchars($exploration['id']) ?>" data-type="exploration">Modifier</button>
                                            <button class="btn-small delete" data-id="<?= htmlspecialchars($exploration['id']) ?>" data-type="exploration">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Media Tab -->
                    <div class="tab-content" id="media-tab">
                        <div class="media-upload-area">
                            <div class="upload-zone">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h3>Glissez vos fichiers ici</h3>
                                <p>ou cliquez pour sélectionner</p>
                                <input type="file" multiple accept="image/*,video/*,audio/*">
                            </div>
                        </div>

                        <div class="media-grid">
                            <div class="media-item">
                                <img src="img/geography.jpg" alt="Media">
                                <div class="media-overlay">
                                    <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                    <button class="btn-icon"><i class="fas fa-download"></i></button>
                                    <button class="btn-icon"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="media-info">
                                    <span>geography.jpg</span>
                                    <small>2.3 MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Navigation mobile admin -->
        <nav class="mobile-nav admin-mobile-nav">
            <ul>
                <li><a href="/administration/dashboard"><i class="fas fa-home"></i><span>Accueil</span></a></li>
                <li><a href="/administration/users"><i class="fas fa-users"></i><span>Utilisateurs</span></a></li>
                <li><a href="/administration/contenus"><i class="fas fa-database"></i><span>Contenus</span></a></li>
                <li><a href="/administration/ligues"><i class="fas fa-trophy"></i><span>Ligues</span></a></li>
                <li><a href="/administration/plaintes"><i class="fas fa-flag"></i><span>Plaintes</span></a></li>
                <li><a href="/administration/parametres"><i class="fas fa-cog"></i><span>Paramètres</span></a></li>
            </ul>
        </nav>
    </div>


    <!-- FORMULAIRES POPUP MASQUÉS -->
    <div id="form-quiz" style="display:none">
        <form id="contentFormQuiz" method="POST" action="/administration/add/quiz">
            <div class="form-group">
                <label for="title-quiz">Titre</label>
                <input type="text" id="title-quiz" required name="titre">
            </div>

            <div class="form-group">
                <label for="title-quiz">Image or Link-Image</label>
                <input type="text" id="slug-quiz" require name="slug">
            </div>

            <div class="form-group">
                <label for="title-quiz">Durée</label>
                <input type="text" id="slug-quiz" require name="duration">
            </div>

            <div class="form-group">
                <label for="description-quiz">Description</label>
                <textarea id="description-quiz" rows="3" name="description"></textarea>
            </div>
            

            <div class="form-group">
                <label for="category-quiz">Catégorie</label>
                <select id="category-quiz" required name="category">
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach(\App\Models\Category\Category::getAll() as $category):?>
                     <option value="<?=$category['id_categorie']?>"><?=$category['categorie']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="level-quiz">Tranche d'age</label>
              
                <select id="level-quiz" required name="age">
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
    <div id="form-module" style="display:none">
        <form id="contentFormModule" method="POST" action="/administration/add/module">
            <div class="form-group">
                <label for="title-module">Titre</label>
                <input type="text" id="title-module" required name="titre-module">
            </div>
            <div class="form-group">
                <label for="description-module">Description</label>
                <textarea id="description-module" rows="3"  name="description-module"></textarea>
            </div>

            <div class="form-group">
                <label for="description-module">Contenu</label>
                <textarea id="description-module" rows="3"  name="content-module"></textarea>
            </div>

            <div class="form-group">
                <label for="category-module">Catégorie</label>
                <select id="category-module" required name="category-module">
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach(\App\Models\Category\Category::getAll() as $category):?>
                    <option value="<?=$category['id_categorie']?>"><?=$category['categorie']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="level-module">Niveau</label>
                <select id="level-module" required name="level-module">
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
    
    <div id="form-exploration" style="display:none">
        <form id="contentFormExploration" action="/administration/add/exploration" method="POST" >
            <div class="form-group">
                <label for="title-exploration">Titre</label>
                <input type="text" id="title-exploration" required name="titre">
            </div>
            <div class="form-group">
                <label for="title-exploration">Image</label>
                <input type="text" id="title-image" required placeholder="slug | image path" name="slug">
            </div>
            <div class="form-group">
                <label for="description-exploration">Description</label>
                <textarea id="description-exploration" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="description-exploration">Contenu</label>
                <textarea id="description-contenu" rows="3" placeholder="markdown" name="contenu"></textarea>
            </div>
            <div class="form-group">
                <label for="category-exploration">Catégorie</label>
                <select id="category-exploration" required name="categorie">
                  <option value="">Sélectionner une catégorie</option>
                <?php foreach(\App\Models\Category\Category::getAll() as $category):?>
                    <option value="<?=$category['id_categorie']?>"><?=$category['categorie']?></option>
                <?php endforeach ?>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel">Annuler</button>
                <button type="submit" class="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>    

   <div id="preview-modal" style="display:none;">
     <div class="modal-content">
       <span class="close-btn">&times;</span>
       <img id="preview-img" src="" alt="Image du jeu" style="max-width:100%;">
       <h2 id="preview-title"></h2>
       
       <p><strong>Catégorie :</strong> <span id="preview-category"></span></p>
       <p><strong>Tranche d'âge :</strong> <span id="preview-age"></span></p>
       <p><strong>Durée :</strong> <span id="preview-duration"></span></p>
       <p><strong>Description :</strong> <span id="preview-description"></span></p>
     </div>
   </div>

<div id="edit-module-modal" style="display:none;">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <h2>Modifier le module</h2>
    <form id="edit-module-form">
      <input type="hidden" id="edit-module-id" name="id">
      <div class="form-group">
        <label for="edit-module-title">Titre</label>
        <input type="text" id="edit-module-title" name="noms" required>
      </div>
      <div class="form-group">
        <label for="edit-module-desc">Description</label>
        <textarea id="edit-module-desc" name="discribe_mod" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="edit-modal-content">Contenu</label>
        <input type="text" id="edit-modal-content" name="content">
      </div>

      <div class="form-group">
         <label for="edit-module-age">level</label>
         <input type="text" id="edit-module-age" name="age">
      </div>

      <div class="form-group">
        <label for="edit-module-image">Image Or Slug image</label>
        <input type="text" id="edit-module-image" name="image">
      </div>

      <div class="form-group">
        <label for="edit-module-category">Catégorie</label>
        <select id="edit-module-category" name="category">
          <option value="">Sélectionner une catégorie</option>
          <?php foreach(\App\Models\Category\Category::getAll() as $category):?>
            <option value="<?= $category['id_categorie'] ?>"><?= $category['categorie'] ?></option>
          <?php endforeach ?>
        </select>
      </div>


      <div class="form-actions">
        <button type="button" class="btn-cancel">Annuler</button>
        <button type="submit" class="btn-save">Enregistrer</button>
      </div>
    </form>
  </div>
</div>
  
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/popup.js"></script>
    <script src="/js/script.js" defer></script>
    <script src="/js/analytics.js"></script>
    <script src="/js/admin-dashboard.js"></script>
    <script>
    document.querySelectorAll('.btn-small.delete, .btn-icon.delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            let url = '';
            if (type === 'exploration') {
                url = `/administration/exploration/${id}`;
            } else if (type === 'module') {
                url = `/administration/module/${id}`;
            } else if (type === 'quiz') {
                url = `/administration/quiz/${id}`;
            }
            if (confirm('Voulez-vous vraiment supprimer cet élément ?')) {
                fetch(url, {
                    method: 'DELETE'
                })
                .then(res => {
                    if (res.ok) {
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                });
            }
        });
    });

    function modifierExploration(id, data) {
        fetch(`/administration/exploration/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => {
            if (res.ok) {
                location.reload();
            } else {
                alert('Erreur lors de la modification');
            }
        });
    }

    document.querySelectorAll('.btn-icon.view').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        fetch(`/api/game/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('preview-img').src = data[0].slug_img || 'img/placeholder.svg';
                document.getElementById('preview-title').textContent = data[0].titre || '';
                document.getElementById('preview-description').textContent = data[0].description || '';
                document.getElementById('preview-category').textContent = data[0].categorie || '';
                document.getElementById('preview-age').textContent = data[0].age || '';
                document.getElementById('preview-duration').textContent = data[0].duration || '';
               
                document.getElementById('preview-modal').style.display = 'block';
            });
    });
});
document.querySelector('#preview-modal .close-btn').onclick = function() {
    document.getElementById('preview-modal').style.display = 'none';
};
// Ouvre la pop-up de modification et pré-remplit les champs
document.querySelectorAll('.module-card-admin .btn-small.edit[data-type="module"]').forEach(btn => {
    btn.addEventListener('click', function() {
        const moduleCard = this.closest('.module-card-admin');
        const moduleId = moduleCard.querySelector('.module-header').getAttribute('data-id');
        // Récupère les infos du module depuis le DOM (ou via fetch si tu préfères)
        const title = moduleCard.querySelector('h3').textContent.trim();
        const desc = moduleCard.querySelector('p').textContent.trim();
        const image = moduleCard.querySelector('img').getAttribute('src');

        // Remplit le formulaire
        document.getElementById('edit-module-id').value = moduleId;
        document.getElementById('edit-module-title').value = title;
        document.getElementById('edit-module-desc').value = desc;
        document.getElementById('edit-module-image').value = image;

        // Affiche la pop-up
        document.getElementById('edit-module-modal').style.display = 'flex';
    });
});

// Fermer la pop-up
document.querySelector('#edit-module-modal .close-btn').onclick = function() {
    document.getElementById('edit-module-modal').style.display = 'none';
};
document.querySelector('#edit-module-modal .btn-cancel').onclick = function() {
    document.getElementById('edit-module-modal').style.display = 'none';
};

// Soumission du formulaire de modification
document.getElementById('edit-module-form').onsubmit = function(e) {
    e.preventDefault();
    const form = document.getElementById('edit-module-form');
    const datas = new FormData(form);
 
    const id = document.getElementById('edit-module-id').value;
    const data = {
        titre: document.getElementById('edit-module-title').value,
        description: document.getElementById('edit-module-desc').value,
        contenu : document.getElementById('edit-modal-content').value,
        level: document.getElementById('edit-module-age').value,
        image: document.getElementById('edit-module-image').value,
        categorie : document.getElementById('edit-module-category').value
    };
    fetch(`/administration/module/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => {
        if (res.ok) {
            location.reload();
        } else {
            alert('Erreur lors de la modification');
        }
    });
    console.log(datas);
};
// Filtre par niveau (tranche d'âge)
document.querySelector('.filter-options select#level-quiz')?.addEventListener('change', function() {
    const selectedAge = this.value;
    document.querySelectorAll('.content-table tbody tr').forEach(row => {
        const age = row.getAttribute('data-age');
        if (!selectedAge || selectedAge === "Tous les niveaux" || age === selectedAge) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});


fetch('http://localhost:8000/api/categories')
  .then(res => res.json())
  .then(categories => {
    // Sélecteurs pour tous les selects de catégorie (quiz, module, exploration)
    const selects = [
      document.getElementById('category-quiz'),
      document.getElementById('category-module'),
      document.getElementById('category-exploration')
    ].filter(Boolean); // retire les null si certains selects n'existent pas

    selects.forEach(select => {
      // Vide les anciennes options sauf la première
      select.length = 1;
      categories.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.id_categorie || cat.id || cat.value || '';
        option.textContent = cat.categorie || cat.nom || '';
        select.appendChild(option);
      });
    });
  })
  .catch(() => {
    // Optionnel : afficher une erreur ou laisser les options statiques
    console.log("Erreur lors du chargement des catégories");
  });
  // Filtre par catégorie
document.getElementById('category-quiz')?.addEventListener('change', function() {
    const selectedCat = this.value;
    document.querySelectorAll('.content-table tbody tr').forEach(row => {
        const cat = row.getAttribute('data-category');
        if (!selectedCat || selectedCat === "Toutes les catégories" || cat === selectedCat) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
// Pagination JS pour les quiz (5 par page)
const rows = Array.from(document.querySelectorAll('.content-table tbody tr'));
const rowsPerPage = 5;
let currentPage = 1;

function showPage(page) {
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    currentPage = Math.max(1, Math.min(page, totalPages));
    rows.forEach((row, i) => {
        row.style.display = (i >= (currentPage-1)*rowsPerPage && i < currentPage*rowsPerPage) ? '' : 'none';
    });
    document.querySelector('.pagination-info').textContent = `Page ${currentPage} sur ${totalPages}`;
    document.querySelector('.pagination-btn.prev').disabled = currentPage === 1;
    document.querySelector('.pagination-btn.next').disabled = currentPage === totalPages;
}

// Ajoute les classes pour les boutons
document.querySelector('.pagination-btn:first-child').classList.add('prev');
document.querySelector('.pagination-btn:last-child').classList.add('next');

// Navigation
document.querySelector('.pagination-btn.prev').onclick = () => showPage(currentPage - 1);
document.querySelector('.pagination-btn.next').onclick = () => showPage(currentPage + 1);

// Affiche la première page au chargement
showPage(1);
    </script>
</body>
</html>

<?php
 require __DIR__ .'/view.php';
?>
