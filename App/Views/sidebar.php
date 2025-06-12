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
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/home" ? "active" : null ?>"><a href="/home"><i class="fas fa-home"></i> Accueil</a></li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/jeux" ? "active" : null ?>"><a href="/jeux"><i class="fas fa-gamepad"></i> Jeux</a></li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/ligue" ? "active" : null ?>"><a href="/ligue"><i class="fas fa-trophy"></i> Ligues</a></li>
                    

                    <?php if(isset($_SESSION['user'])): ?>
                        <li class="<?= $_SERVER['REQUEST_URI'] === "/profile" ? "active" : null ?>"><a href="/profile"><i class="fas fa-user"></i> Profil</a></li>
                        <li class="<?= $_SERVER['REQUEST_URI'] === "/parametres" ? "active" : null ?>"><a href="/parametres"><i class="fas fa-cog"></i> Paramètres</a></li>
                    <?php else: ?>
                        <?= Component::Link("/login","Login",$_SERVER['REQUEST_URI'] === "/login" ? "active" : '' ,"<i class='fa-solid fa-lock'></i>") ?>
                        
                    <?php endif; ?>
                    <?= Component::Link("/explorations","Explorations",$_SERVER['REQUEST_URI'] === "/explorations" ? "active" : '' ,"<i class='fa-brands fa-wpexplorer'></i>") ?>
                    <?= Component::Link("/dashboard","Dashboard",$_SERVER['REQUEST_URI'] === "/dashboard" ? "active" : '',"<i class='fa-solid fa-user-tie'></i>") ?>
                    <?= Component::Link("/chat","Chat",$_SERVER['REQUEST_URI'] === "/chat" ? "active" : '',"<i class='fa-solid fa-comment'></i>") ?>
                    
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