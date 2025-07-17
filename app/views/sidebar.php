<?php
 use App\Models\Component\Component;
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <img src="/assets/logo.jpeg" alt="Logo" class="logo">
        <h1>Le Monde<br>Dans Ma Poche</h1>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <!-- Liens accessibles à tous les utilisateurs connectés -->
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/home" ? "active" : null ?>">
                <a href="/user/home"><i class="fas fa-home"></i> Accueil</a>
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/jeux" ? "active" : null ?>">
                <a href="/user/jeux"><i class="fas fa-gamepad"></i> Jeux</a>
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/modules" ? "active" : null ?>">
                <a href="/user/modules"><i class="fas fa-cubes"></i> Modules</a>
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/explorations" ? "active" : null ?>">
                <a href="/user/explorations"><i class="fa-brands fa-wpexplorer"></i> Explorations</a>
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/ligue" ? "active" : null ?>">
                <a href="/user/ligue"><i class="fas fa-trophy"></i> Ligues</a>
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/chat" ? "active" : null ?>">
                <a href="/user/chat"><i class="fa-solid fa-comment"></i> Chat</a>
            </li>

            <?php if(isset($_SESSION['user'])): ?>
                <li class="<?= $_SERVER['REQUEST_URI'] === "/user/profile" ? "active" : null ?>">
                    <a href="/user/profile"><i class="fas fa-user"></i> Profil</a>
                </li>
                <li class="<?= $_SERVER['REQUEST_URI'] === "/user/parametres" ? "active" : null ?>">
                    <a href="/user/parametres"><i class="fas fa-cog"></i> Paramètres</a>
                </li>
                <!-- Liens spécifiques pour l'administrateur -->
                <?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'administrateur'): ?>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/administration/dashboard" ? "active" : null ?>">
                        <a href="/administration/dashboard"><i class="fa-solid fa-user-tie"></i> Dashboard Admin</a>
                    </li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/administration/users" ? "active" : null ?>">
                        <a href="/administration/users"><i class="fa-solid fa-users"></i> Utilisateurs</a>
                    </li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/administration/contenus" ? "active" : null ?>">
                        <a href="/administration/contenus"><i class="fa-solid fa-database"></i> Contenus</a>
                    </li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/administration/ligues" ? "active" : null ?>">
                        <a href="/administration/ligues"><i class="fa-solid fa-trophy"></i> Ligues (Admin)</a>
                    </li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/administration/plaintes" ? "active" : null ?>">
                        <a href="/administration/plaintes"><i class="fa-solid fa-flag"></i> Plaintes</a>
                    </li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/administration/settings" ? "active" : null ?>">
                        <a href="/administration/settings"><i class="fa-solid fa-cogs"></i> Paramètres Admin</a>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                <?= Component::Link("/login","Login",$_SERVER['REQUEST_URI'] === "/login" ? "active" : '' ,"<i class='fa-solid fa-lock'></i>") ?>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <div class="user-info">
            <img src="<?= $_SESSION['user']['avatar'] ?? '/assets/avatar.png'?>" alt="Avatar" class="avatar">
            <div>
                <p class="username"><?php echo isset($_SESSION['user']['prenoms']) ? $_SESSION['user']['prenoms'] : 'Invité'; ?></p>
                <p class="rank"><?php echo isset($_SESSION['user']['role']) ? ucfirst($_SESSION['user']['role']) : ''; ?></p>
            </div>
        </div>
    </div>
</aside>        