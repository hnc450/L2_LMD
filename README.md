# Le Monde Dans Ma Poche - Interface d'Administration

## Structure du Projet
## pour retirer  un dossier ou un fichier du versionning 
```
     git rm --cached -r vendor composer.lock
```
```
admin_front_end/
├── assets/
│   ├── css/          # Fichiers CSS
│   ├── js/           # Fichiers JavaScript
│   ├── img/          # Images
│   └── fonts/        # Polices
├── pages/            # Pages HTML
├── components/       # Composants réutilisables
└── README.md
```

## Organisation des Fichiers

### Assets
- `css/` : Contient tous les fichiers de style
  - `theme.css` : Thème principal
  - `dashboard.css` : Styles du tableau de bord
  - `analytics.css` : Styles des graphiques et statistiques
  - `popup.css` : Styles des fenêtres modales

- `js/` : Contient tous les fichiers JavaScript
  - `theme.js` : Gestion du thème
  - `dashboard.js` : Fonctionnalités du tableau de bord
  - `analytics.js` : Gestion des graphiques et statistiques
  - `popup.js` : Gestion des fenêtres modales
  - `include.js` : Fonctions utilitaires communes

### Pages
- `contenu.html` : Gestion du contenu
- `analytics.html` : Statistiques et analyses
- `accueil.html` : Page d'accueil
- `ligues.html` : Gestion des ligues
- `logs.html` : Journal des activités
- `feedbacks.html` : Gestion des retours
- `utilisateurs.html` : Gestion des utilisateurs
- `parametres.html` : Paramètres de l'application
- `statistiques.html` : Statistiques détaillées

## Fonctionnalités Principales

1. **Gestion du Contenu**
   - Création et modification de quiz
   - Gestion des modules
   - Gestion des explorations

2. **Analytics**
   - Graphiques interactifs
   - Filtres de date
   - Statistiques en temps réel

3. **Interface Utilisateur**
   - Thème clair/sombre
   - Design responsive
   - Animations fluides

## Dépendances

- Font Awesome 6.4.0
- Chart.js (pour les graphiques)
- Altorouter (pour les routes)

## Installation

1. Clonez le dépôt
2. Ouvrez les fichiers HTML dans votre navigateur
3. Pour le développement, utilisez un serveur local

## Développement

Pour ajouter de nouvelles fonctionnalités :
1. Créez les fichiers nécessaires dans les dossiers appropriés
2. Mettez à jour les chemins dans les fichiers HTML
3. Testez sur différents navigateurs 
