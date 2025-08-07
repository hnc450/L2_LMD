<?php 
    $stats = \App\Controllers\Admin\Admin::voir_toutes_les_informations();
    $logs = \App\Controllers\FactoryController::getController('Log')->allLog();  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Le Monde Dans Ma Poche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/dash-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar will be loaded here -->
        <div class="sidebar-container"></div>

        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header pour toutes les tailles d'écran -->
           <?php require __DIR__ . '/templates/navbar.php' ?>
        
            <div class="dashboard-content">
                <!-- Statistiques -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>
                                <?= $stats['actifs_users'][0]['actifs'] ?>
                            </h3>
                            <p>Utilisateurs actifs</p>
                            <!-- <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>12% ce mois</span>
                            </div> -->
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon quizzes">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?= $stats['explorations'][0]['nombres_explorations'] ?></h3>
                            <p>Explorations</p>
                            <!-- <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>8% ce mois</span>
                            </div> -->
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon questions">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?=$stats['jeux'][0]['nombres_jeux']?></h3>
                            <p>Jeux</p>
                            <!-- <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>15% ce mois</span>
                            </div> -->
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon categories">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="stat-info">
                            <h3>
                                <?= $stats['categories'][0]['nombre_categorie'] ?>
                            </h3>
                            <p>Catégorie<?= $stats['categories'][0]['nombre_categorie'] > 1 ?'s':'' ?></p>
                            <!-- <div class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>5% ce mois</span>
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="quick-actions">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3>Nouveau Jeu</h3>
                        <p>Créer un nouveau quiz</p>
                    </div>

                    <div class="action-card" id="open-user-modal">
                       <div class="action-icon">
                           <i class="fas fa-user-plus"></i>
                       </div>
                       <h3>Nouvel Utilisateur</h3>
                       <p>Ajouter un utilisateur</p>
                    </div>


                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-folder-plus" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                        </div>
                        <h3>Nouvelle Catégorie</h3>
                        <p>Créer une catégorie</p>
                    </div>

                    <div class="action-card">
                        <div class="action-icon">
                             <a href="/administration/settings" style="color: white; text-decoration: none;">
                               <i class="fas fa-cog"></i>
                             </a>
                        </div>
                        <h3>Paramètres</h3>
                        <p>Configurer le jeu</p>
                    </div>
                </div>

                <!-- Activité récente -->
                <div class="recent-activity">
                    <div class="activity-header">
                        <h2><i class="fas fa-history"></i> Activité Récente</h2>
                    </div>

                    <div class="activity-list">
                      <?php foreach($logs as $log):?>
                        <div class="activity-item">
                            <div class="activity-icon quiz">
                                <i class="<?= $log['icon'] ?>"></i>
                            </div>
                            <div class="activity-info">
                                <h4><?= $log['actions'] ?></h4>
                                <p> <?= $log['descriptions'] ?> </p>
                            </div>
                            <span class="activity-time"> <?= $log['temps'] ?> </span>
                        </div>
                      <?php endforeach ?>

                        <!-- <div class="activity-item">
                            <div class="activity-icon user">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-info">
                                <h4>Nouvel utilisateur</h4>
                                <p>Marie Martin s'est inscrite</p>
                            </div>
                            <span class="activity-time">Il y a 15 min</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon category">
                                <i class="fas fa-folder"></i>
                            </div>
                            <div class="activity-info">
                                <h4>Nouvelle catégorie</h4>
                                <p>Catégorie "Géographie" ajoutée</p>
                            </div>
                            <span class="activity-time">Il y a 1h</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon question">
                                <i class="fas fa-question"></i>
                            </div>
                            <div class="activity-info">
                                <h4>Questions ajoutées</h4>
                                <p>50 nouvelles questions ajoutées</p>
                            </div>
                            <span class="activity-time">Il y a 2h</span>
                        </div> -->
                    </div>
                </div>
                

                <!-- Métriques de performance -->
                <div class="performance-metrics">
                    <div class="metric-card">
                        <div class="metric-header">
                            <h3>Taux de complétion</h3>
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="metric-value">85%</div>
                        <div class="metric-chart"></div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-header">
                            <h3>Temps moyen</h3>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="metric-value">4.5 min</div>
                        <div class="metric-chart"></div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-header">
                            <h3>Score moyen</h3>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="metric-value">78%</div>
                        <div class="metric-chart"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <form action="/administration/add/category" method="POST">
           <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Nouvelle categorie</h1>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="description" class="text-white">Id category</label>
                    <input type="text" class="form-control"  value="<?= uniqid() ?>"  placeholder="Category ID" name="categoryId" readonly>
                  </div>

                  <div class="form-group">
                   
                    <label for="categoryName" class="text-white">Category Name</label>
                    <textarea class="form-control" id="description" rows="3" name="categoryName" required></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
    </form>

<!-- Pop-up d'ajout utilisateur -->
<div id="user-modal" class="modal-user">
  <div class="modal-user-content">
    <span class="close-user-modal">&times;</span>
    <h2>Ajouter un utilisateur</h2>
    <form action="/admin/add/user" method="post" class="user-form">
      <input type="text" name="prenom" placeholder="Prénom" required>
      <input type="text" name="pseudo" placeholder="Pseudo" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="age" placeholder="Âge" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <input type="password" name="confirmPassword" placeholder="Confirmation du mot de passe" required>
      <select name="role" required>
        <option value="">Rôle</option>
        <option value="utilisateur">Utilisateur</option>
        <option value="administrateur">Administrateur</option>
      </select>
      <select name="sexe" required>
        <option value="">Sexe</option>
        <option value="masculin">Masculin</option>
        <option value="feminin">Féminin</option>
      </select>
      <button type="submit" class="btn-user-submit">Ajouter</button>
    </form>
  </div>
</div>


    <script>
    // Ouvre la pop-up
    document.getElementById('open-user-modal').onclick = function() {
      document.getElementById('user-modal').classList.add('active');
    };
    // Ferme la pop-up
    document.querySelector('.close-user-modal').onclick = function() {
      document.getElementById('user-modal').classList.remove('active');
    };
    // Ferme aussi si on clique en dehors du contenu
    document.getElementById('user-modal').onclick = function(e) {
      if(e.target === this) this.classList.remove('active');
    };
    </script>
 
  
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/script.js" defer></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html> 