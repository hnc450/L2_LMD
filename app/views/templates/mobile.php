 <!-- Navigation mobile -->
        <nav class="mobile-nav">
            <ul>
                <li class=" <?= $_SERVER['REQUEST_URI'] === "/user/home" ? 'active':''?>">
                    <a href="/user/home">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>

                <li class="<?= $_SERVER['REQUEST_URI'] === "/user/jeux" ? 'active':''?>">
                    <a href="/user/jeux">
                        <i class="fas fa-gamepad"></i>
                        <span>Jeux</span>
                    </a>
                </li>

                <li class="<?= $_SERVER['REQUEST_URI'] === "/user/explorations" ? 'active':''?>">
                    <a href="/user/explorations">
                     <i class="fa-brands fa-wpexplorer"></i>
                     <span></span>Explorations</li>
                    </a>
                </li>
                <li class="<?= $_SERVER['REQUEST_URI'] === "/user/profile" ? 'active':''?>">
                    <a href="/user/profile">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </li>

                <li>
                    <a href="/user/modules">
                        <i class="fas fa-cubes"></i>
                        <span>Modules </span>
                    </a>
                </li>

                <li class="<?= $_SERVER['REQUEST_URI'] === "/user/ligue" ? 'active':''?>">
                    <a href="/user/ligue">
                        <i class="fas fa-trophy"></i>
                        <span>Ligues</span>
                    </a>
                </li>

                <li class="<?= $_SERVER['REQUEST_URI'] === "/user/parametres" ? 'active':''?>">
                    <a href="/user/parametres">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
            </ul>
        </nav>