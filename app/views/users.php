<?php 
    $utilisateurs = \App\Controllers\Admin\Admin::voir_toutes_les_informations();
    $image_uri = "data:image/png;base64,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";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/users.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar will be loaded here -->
        <div class="sidebar-container"></div>

        <!-- Contenu principal -->
        <main class="main-content">
            <!-- Header pour toutes les tailles d'écran -->
            <?php require  __DIR__ . '/templates/navbar.php'; ?>

            <div class="dashboard-content">
                <!-- Slider/Carrousel d'infos rapides -->
                <div class="user-slider">
                    <div class="slider-track" id="sliderTrack">
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-users"></i> Utilisateurs inscrits</div>
                            <div class="slide-value"><?= $utilisateurs['utilisateurs_inscrits'][0]['utilisateurs_inscrits'] ?></div>
                        </div>
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-user-check"></i>Utilisateurs Actifs</div>
                            <div class="slide-value"><?= $utilisateurs['actifs_users'][0]['actifs'] ?></div>
                        </div>
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-user-plus"></i> Utilisateurs Inactifs</div>
                            <div class="slide-value"><?= $utilisateurs['inatifs_user'][0]['inatifs'] ?></div>
                        </div>
                        <div class="slide-card">
                            <div class="slide-title"><i class="fas fa-user-shield"></i> Admins</div>
                            <div class="slide-value"><?= $utilisateurs['administrateurs'][0]['administrateurs']?></div>
                        </div>
                    </div>
                    <div class="slider-nav">
                        <button class="slider-btn" id="sliderPrev"><i class="fas fa-chevron-left"></i></button>
                        <button class="slider-btn" id="sliderNext"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Filtres et Recherche -->
                <div class="filters-section">
                    <div class="search-filter">
                        <input type="text" placeholder="Rechercher un utilisateur...">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option>Tous les rôles</option>
                            <option>Administrateur</option>
                            <option>utilisateur</option>
                        </select>
                        <select class="filter-select">
                            <option>Tous les statuts</option>
                            <option>Actif</option>
                            <option>Inactif</option>
                            <!-- <option>Banni</option> -->
                        </select>
                    </div>
                </div>
     
                <!-- Liste des Utilisateurs -->
                <div class="users-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Utilisateur</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Pseudo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        <?php foreach (\App\Controllers\Admin\Admin::get_all_users() as $users) : ?>
                            
                                <tr>
                                    <td>#<?= $users['id_user'] ?></td>
                                    <td>
                                        <div class="user-info">
                                            <img src="<?= $image_uri ?>" alt="Avatar" class="user-avatar">
                                            <div>
                                                <p class="user-name"><?= $users['prenoms'] ?></p>
                                                <p class="user-email"><?= $users['mails'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="role-badge <?= $users['role'] == 'utilisateur' ? 'player' : 'admin' ?>"><?= $users['role'] ?></span></td>
                                    <td><span class="status-badge <?= $users['status'] == 1 ? 'active' : 'inactive' ?>" style="color:white"><?= $users['status'] == 1 ? 'Actif' : 'Inactif' ?></span></td>
                                    <td><?= $users['pseudo'] ?></td>
                                    <td>
                                      <div class="action-buttons">
                                          <button class="btn-icon edit edit-user-btn" title="Modifier"
                                            data-user-id="<?= $users['id_user'] ?>"
                                            data-user-prenoms="<?= htmlspecialchars($users['prenoms']) ?>"
                                            data-user-pseudo="<?= htmlspecialchars($users['pseudo']) ?>"
                                            data-user-email="<?= htmlspecialchars($users['mails']) ?>"
                                            data-user-role="<?= htmlspecialchars($users['role']) ?>"
                                            data-user-status="<?= htmlspecialchars($users['status']) ?>"
                                            data-user-genre="<?= htmlspecialchars($users['genre']) ?>"
                                            data-user-role="<?= htmlspecialchars($users['role'])?>"

                                          >
                                              <i class="fas fa-edit" style="color: #fff;"></i>
                                          </button>
                                          <a href="/administration/user/<?= $users['id_user'] ?>" style="text-decoration: none;">
                                                 <button class="btn-icon ban" title="Bannir" >
                                                     <i class="fas fa-eye" ></i>
                                                 </button>
                                          </a>
                                          <button class="btn-icon delete" title="Supprimer" data-user-id="<?= $users['id_user'] ?>" style="color: #fff;">
                                              <i class="fa-solid fa-trash"></i>
                                          </button>
                                      </div>
                                    </td>
                                </tr>
                         <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- Formulaire de modification utilisateur (caché par défaut) -->
          

               <div id="edit-user-modal">
                 <div class="modal-content">
                   <div class="modal-header">
                     Modifier l'utilisateur
                     <button type="button" class="close-modal" id="close-edit-user-modal" title="Fermer">&times;</button>
                   </div>
                   <form id="edit-user-form" method="POST" action="">
                     <div>
                         <label for="edit-id-user">Id :</label>
                          <input name="id_user" id="edit-id-user" type="text">
                     </div>
                   
                     <div>
                       <label for="edit-prenoms">Prénom :</label>
                       <input type="text" id="edit-prenoms" name="prenom" value="" required>
                     </div>

                     <div>
                        <label for="edit-status">Status (1 or 0)</label>
                        <input type="text" name="status" id="edit-status" value="" required>
                    </div>

                     <div>
                       <label for="edit-pseudo">Pseudo :</label>
                       <input type="text" id="edit-pseudo" name="pseudo" value="" required>
                     </div>
                     <div>
                       <label for="edit-email">Email :</label>
                       <input type="email" id="edit-email" name="email" value="" required>
                     </div>

                     <div>
                        <label for="edit-genre">Genre :</label>
                        <input type="text" id="edit-genre" name="genre" value="" required>
                     </div>

                     <div>
                        <label for="edit-role">Role :</label>
                        <input type="text" type="text" id="edit-role" name="role" value="" required>
                     </div>

                     <div>

                     </div>
                     <div style="margin-top:18px;">
                       <button type="submit" class="btn-primary">Enregistrer</button>
                       <button type="button" id="cancel-edit-user" class="btn-danger">Annuler</button>
                     </div>
                   </form>
                 </div>
               </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i></button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
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
    
    <script src="/js/dashboard.js"></script>
    <script src="/js/include.js"></script>
    <script src="/js/request.js"></script>
    <!-- <script src="/js/admin-users.js"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('sliderTrack');
            const prev = document.getElementById('sliderPrev');
            const next = document.getElementById('sliderNext');
            let slideIndex = 0;
            const slides = document.querySelectorAll('.slide-card');
            const visibleSlides = window.innerWidth < 900 ? 1 : 3;
            function updateSlider() {
                const slideWidth = slides[0].offsetWidth + 32; // 32px = gap
                track.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
            }
            prev.onclick = () => {
                if (slideIndex > 0) {
                    slideIndex--;
                    updateSlider();
                }
            };
            next.onclick = () => {
                if (slideIndex < slides.length - visibleSlides) {
                    slideIndex++;
                    updateSlider();
                }
            };
            window.addEventListener('resize', updateSlider);
            updateSlider();
        });
    </script>
    <script>
document.querySelectorAll('.edit-user-btn').forEach(function(btn) {
  btn.addEventListener('click', function() {
    document.getElementById('edit-id-user').value = btn.getAttribute('data-user-id');
    document.getElementById('edit-prenoms').value = btn.getAttribute('data-user-prenoms');
    document.getElementById('edit-pseudo').value = btn.getAttribute('data-user-pseudo');
    document.getElementById('edit-email').value = btn.getAttribute('data-user-email');
    document.getElementById('edit-genre').value = btn.getAttribute('data-user-genre');
    document.getElementById('edit-role').value = btn.getAttribute('data-user-role');
    document.getElementById('edit-status').value = btn.getAttribute('data-user-status')
    document.getElementById('edit-user-form').action = '/administration/edit/user/' + btn.getAttribute('data-user-id');
    document.getElementById('edit-user-modal').classList.add('active');
  });
});
document.getElementById('cancel-edit-user').addEventListener('click', function() {
  document.getElementById('edit-user-modal').classList.remove('active');
});
document.getElementById('close-edit-user-modal').addEventListener('click', function() {
  document.getElementById('edit-user-modal').classList.remove('active');
});
// Fermer le modal si on clique en dehors du contenu
window.addEventListener('click', function(e) {
  const modal = document.getElementById('edit-user-modal');
  if (e.target === modal) {
    modal.classList.remove('active');
  }
});
document.querySelector('.search-filter input').addEventListener('input', function() {
    const search = this.value.toLowerCase();
    document.querySelectorAll('.users-table tbody tr').forEach(row => {
        // On cherche dans toutes les cellules du tr
        const text = row.textContent.toLowerCase();
        if (text.includes(search)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
document.querySelectorAll('.filter-select').forEach(function(select) {
    select.addEventListener('change', function() {
        const selectedRole = document.querySelectorAll('.filter-select')[0].value.toLowerCase();
        const selectedStatus = document.querySelectorAll('.filter-select')[1].value.toLowerCase();

        document.querySelectorAll('.users-table tbody tr').forEach(row => {
            const role = row.querySelector('.role-badge')?.textContent.toLowerCase() || '';
            const status = row.querySelector('.status-badge')?.textContent.toLowerCase() || '';

            let show = true;
            if (selectedRole !== 'tous les rôles' && role !== selectedRole) show = false;
            if (selectedStatus !== 'tous les statuts' && status !== selectedStatus) show = false;

            row.style.display = show ? '' : 'none';
        });
    });
});
</script>
    <script src="/js/script.js" defer></script>
</body>
</html> 