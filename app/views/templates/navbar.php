<style>
    .main-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(90deg, #23242a 60%, #3a256a 100%);
        padding: 1.2rem 2.5rem 1.2rem 2rem;
        border-radius: 0 0 18px 18px;
        box-shadow: 0 4px 24px rgba(41, 38, 80, 0.10);
        color: #f3f3f3;
        position: relative;
        z-index: 10;
        gap: 1.5rem;
    }
    .header-left {
        display: flex;
        align-items: center;
        gap: 1.2rem;
    }
    .logo {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #fff;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(41,128,185,0.08);
    }
    .main-header h1 {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: 1px;
        color: #6dd5fa;
        margin: 0;
    }
    .main-nav {
        display: flex;
        gap: 1.2rem;
        align-items: center;
        transition: all 0.3s;
        position: relative;
        background: none;
        box-shadow: none;
    }
    .main-header a {
        color: #f3f3f3;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.08rem;
        padding: 0.5rem 1.1rem;
        border-radius: 7px;
        transition: background 0.18s, color 0.18s;
        display: block;
    }
    .main-header a:hover, .main-header a.active {
        background: #6dd5fa;
        color: #23242a;
    }
    .header-right {
        display: flex;
        align-items: center;
        gap: 1.3rem;
    }
    .theme-toggle-container {
        margin-right: 0.5rem;
    }
    .user-info-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        background: #181828;
        padding: 0.4rem 1rem 0.4rem 0.6rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(41,128,185,0.08);
    }
    .user-info-header .avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #6dd5fa;
        background: #fff;
    }
    .user-info-header .username {
        font-weight: 700;
        color: #6dd5fa;
        margin: 0;
        font-size: 1.08rem;
    }
    .user-info-header .rank {
        font-size: 0.95rem;
        color: #b2bec3;
        margin: 0;
        font-weight: 500;
    }
    /* Burger menu styles */
    .burger-menu {
        display: none;
        flex-direction: column;
        justify-content: center;
        cursor: pointer;
        width: 38px;
        height: 38px;
        margin-left: 1rem;
        z-index: 20;
    }
    .burger-bar {
        height: 4px;
        width: 28px;
        background: #6dd5fa;
        margin: 4px 0;
        border-radius: 2px;
        transition: 0.3s;
    }
    /* Responsive */
    @media (max-width: 900px) {
        .main-header {
            flex-direction: column;
            align-items: stretch;
            padding: 1.2rem 1rem;
            gap: 0.7rem;
        }
        .header-left {
            width: 100%;
            justify-content: space-between;
        }
        .main-nav {
            flex-direction: column;
            width: 100%;
            background: #23242a;
            position: absolute;
            top: 100%;
            left: 0;
            border-radius: 0 0 18px 18px;
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.13);
            display: none;
            padding: 1rem 0;
            z-index: 15;
        }
        .main-nav.open {
            display: flex;
        }
        .burger-menu {
            display: flex;
        }
        .header-right {
            align-self: flex-end;
            margin-top: 0.7rem;
        }
    }
    @media (max-width: 600px) {
        .main-header h1 {
            font-size: 1.2rem;
        }
        .logo {
            width: 36px;
            height: 36px;
        }
        .user-info-header {
            padding: 0.3rem 0.7rem 0.3rem 0.4rem;
        }
        .user-info-header .avatar {
            width: 28px;
            height: 28px;
        }
    }
</style>
<header class="main-header">
    <div class="header-left">
        <span class="logo" style="display:flex;align-items:center;justify-content:center;background:#fff;">
            <i class="fas fa-globe-europe" style="font-size:2rem;color:#3a256a;"></i>
        </span>
        <h1>Tableau de Bord</h1>
        <div class="burger-menu" id="burgerMenu" aria-label="Ouvrir le menu" tabindex="0">
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
        </div>
    </div>
    <nav class="main-nav" id="mainNav">
        <a href="/user/home">home</a>
        <a href="/administration/dashboard">dashboard</a>
        <a href="/administration/contenus">contenus</a>
        <a href="/administration/users">utilisateurs</a>
        <!-- <a href="/administration/settings">parametres</a> -->
    </nav>
    <div class="header-right">
        <!-- Theme Toggle will be loaded here -->
        <div class="theme-toggle-container"></div>
        <div class="user-info-header">
            <img src="<?= $_SESSION['user']['avatar']?>" alt="Avatar" class="avatar">
            <div>
                <p class="username"><?=  $_SESSION['user']['prenoms'] ?></p>
                <p class="rank"> <?= $_SESSION['user']['role'] ?>  </p>
            </div>
        </div>
    </div>
</header>
<script>
    // Burger menu toggle
    const burger = document.getElementById('burgerMenu');
    const nav = document.getElementById('mainNav');
    burger.onclick = function() {
        nav.classList.toggle('open');
    };
    // Fermer le menu quand on clique ailleurs (mobile)
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 900 && !nav.contains(e.target) && !burger.contains(e.target)) {
            nav.classList.remove('open');
        }
    });
    // Accessibilité : ouvrir/fermer avec Entrée ou Espace
    burger.addEventListener('keydown', function(e) {
        if (e.key === "Enter" || e.key === " ") {
            nav.classList.toggle('open');
        }
    });
</script>