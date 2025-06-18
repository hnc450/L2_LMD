<?php
 use App\Models\Component\Component;
?>
<aside class="sidebar">
            <div class="sidebar-header">
                <img src="img/logo.png" alt="Logo" class="logo">
                <h1>Le Monde<br>Dans Ma Poche</h1>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/user/home" ? "active" : null ?>"><a href="/user/home"><i class="fas fa-home"></i> Accueil</a></li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/user/jeux" ? "active" : null ?>"><a href="/user/jeux"><i class="fas fa-gamepad"></i> Jeux</a></li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/user/ligue" ? "active" : null ?>"><a href="/user/ligue"><i class="fas fa-trophy"></i> Ligues</a></li>
                    

                    <?php if(isset($_SESSION['user'])): ?>
                        <li class="<?= $_SERVER['REQUEST_URI'] === "/user/profile" ? "active" : null ?>"><a href="/user/profile"><i class="fas fa-user"></i> Profil</a></li>
                        <li class="<?= $_SERVER['REQUEST_URI'] === "/user/parametres" ? "active" : null ?>"><a href="/user/parametres"><i class="fas fa-cog"></i> Paramètres</a></li>
                    <?php else: ?>
                        <?= Component::Link("/login","Login",$_SERVER['REQUEST_URI'] === "/login" ? "active" : '' ,"<i class='fa-solid fa-lock'></i>") ?>
                        
                    <?php endif; ?>
                    <?= Component::Link("/user/explorations","Explorations",$_SERVER['REQUEST_URI'] === "/user/explorations" ? "active" : '' ,"<i class='fa-brands fa-wpexplorer'></i>") ?>
                    <?= Component::Link("/administration/dashboard","Dashboard",$_SERVER['REQUEST_URI'] === "/administration/dashboard" ? "active" : '',"<i class='fa-solid fa-user-tie'></i>") ?>
                    <?= Component::Link("/user/chat","Chat",$_SERVER['REQUEST_URI'] === "/user/chat" ? "active" : '',"<i class='fa-solid fa-comment'></i>") ?>
                    
                </ul>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <img src="img/avatar.png" alt="Avatar" class="avatar">
                    <div>
                        <p class="username">Thomas Dupont</p>
                        <p class="rank">Ligue Émeraude</p>
                    </div>
                </div>
            </div>
</aside>        