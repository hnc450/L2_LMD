<?php
 use App\Models\Component\Component;
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <span class="logo" style="display:flex;align-items:center;justify-content:center;background:#fff;">
            <i class="fas fa-globe-europe" style="font-size:2rem;color:#3a256a;"></i>
        </span>
        <h1>Ha<br>ppy</h1>
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
                <!-- <a href="/user/modules"><i class="fas fa-cubes"></i> Modules</a> -->
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/explorations" ? "active" : null ?>">
                <a href="/user/explorations"><i class="fa-brands fa-wpexplorer"></i> Explorations</a>
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/ligue" ? "active" : null ?>">
                <a href="/user/ligue"><i class="fas fa-trophy"></i> Points</a>
            </li>
            <li class="<?= $_SERVER['REQUEST_URI'] === "/user/chat" ? "active" : null ?>">
                <!-- <a href="/user/chat"><i class="fa-solid fa-comment"></i> Chat</a> -->
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
                        <a href="/administration/dashboard"><i class="fa-solid fa-user-tie"></i> Dashboard</a>
                    </li>
                   
                    <li class="<?= $_SERVER['REQUEST_URI'] === "/administration/settings" ? "active" : null ?>">
                        <!-- <a href="/administration/settings"><i class="fa-solid fa-cogs"></i> Paramètres Admin</a> -->
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