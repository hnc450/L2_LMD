# 🌍 Le Monde Dans Ma Poche – Interface d'Administration

Bienvenue ! Ce dépôt contient l'interface d'administration du projet **Le Monde Dans Ma Poche**.

---

## 📌 Objectif du projet

Ce projet vise à développer une interface d'administration pour gérer les contenus, utilisateurs, modules et statistiques de l'application éducative "Le Monde Dans Ma Poche".

---

## 🛠️ Technologies utilisées

- Langage principal : `PHP`, `JavaScript`
- Framework : (aucun framework majeur, architecture MVC maison)
- Base de données : `MySQL`
- Outils : `Composer`, `Font Awesome`, `Erusev/Parsedown`, `Altorouter`, `GitHub`

---

## 🚀 Etapes pour lancer le projet

1. Cloner ce dépôt :

```bash
   git clone <url-du-repo>
   cd l2_LMD
```

2. Installer les dépendances PHP :

```bash
   composer install
```

3. Configurer la base de données :
   - Créez une base de données MySQL.
   - Renseignez les identifiants dans `App/Models/Database/Database.php`.
   - Importez le schéma si besoin.

4. Lancer le serveur local :

```bash
   php -S localhost:8000 -t public
```

5. Accéder à l'interface :
   - Ouvrez [http://localhost:8000](http://localhost:8000) dans votre navigateur.

---

## 📁 Structure du projet

```
l2_LMD/
  ┣ App/
  ┃ ┣ Controllers/      # Contrôleurs MVC
  ┃ ┣ Middlewares/      # Middlewares (sécurité, requêtes, upload)
  ┃ ┣ Models/           # Modèles (BDD, entités)
  ┃ ┗ Views/            # Vues (pages HTML/PHP)
  ┣ public/             # Fichiers publics (assets, index.php)
  ┣ route/              # Fichiers de routage
  ┣ routes/             # Définition des routes
  ┣ vendor/             # Dépendances Composer
  ┣ README.md           # Présentation du projet
  ┗ composer.json       # Dépendances PHP
```

---

## 🔁 Gestion du dépôt Git

Pour sauvegarder votre travail :

```bash
git add .
git commit -m "Votre message"
git push origin main
```

---

## 📄 Licence

Projet académique – Usage Strictement Pédagogique.
© 2025 – Université Protestante au Congo - CRIAGI

