# Atelier Framework Web côté serveur - AU 2025/2026

Ce repository contient l'ensemble des travaux pratiques réalisés dans le cadre du cours **Atelier Framework Web côté serveur**  pendant l'année universitaire 2025/2026.

## 📋 Table des matières

- [Vue d'ensemble](#vue-densemble)
- [Prérequis techniques](#prérequis-techniques)
- [Configuration de l'environnement](#configuration-de-lenvironnement)
- [Structure du repository](#structure-du-repository)
- [Technologies utilisées](#technologies-utilisées)
- [Installation et utilisation](#installation-et-utilisation)
- [Ressources utiles](#ressources-utiles)

## 🎯 Vue d'ensemble

Ce repository documente l'apprentissage des frameworks web côté serveur, avec un focus principal sur **Symfony 4**. Tous les travaux pratiques du semestre seront partagés ici, explorant différents aspects du développement web moderne, depuis l'initiation jusqu'aux concepts avancés.

### Objectifs pédagogiques
- Maîtriser l'architecture MVC
- Comprendre les concepts des frameworks web
- Développer des applications web robustes
- Appliquer les bonnes pratiques de développement

## 🛠 Prérequis techniques

### Connaissances requises
- **Base de données** : Serveur BDD, requêtes SQL
- **Langages** : PHP, HTML, CSS
- **Paradigmes** : Programmation Orientée Objet (POO)
- **Architecture** : Modèle MVC

### Outils recommandés
- **Serveur local** : Laragon (recommandé) ou XAMPP
- **Gestionnaire de dépendances** : Composer
- **IDE** : Visual Studio Code
- **Framework** : Symfony 4
- **Contrôle de version** : Git

## ⚙️ Configuration de l'environnement

### Installation rapide avec Laragon
1. Télécharger [Laragon](https://laragon.org/download/)
2. Installer [Composer](https://getcomposer.org/download)
3. Cloner ce repository dans `C:\laragon\www\`
4. Suivre les instructions spécifiques de chaque dossier

### Variables d'environnement
```bash
# Laragon configure automatiquement :
# - PHP PATH
# - Apache/MySQL
# - Composer global
```

## 📁 Structure du repository

```
atelier-framework-web/
├── README.md                    # Ce fichier
├── [dossiers-des-tp]/          # Dossiers des travaux pratiques
│   ├── README.md               # Instructions spécifiques
│   ├── src/                    # Code source
│   └── documentation/          # Notes et captures d'écran
├── resources/                 # Ressources communes
│   ├── docs/                  # Documentation générale
│   ├── templates/             # Templates réutilisables
│   └── assets/                # Images, CSS communs
└── .gitignore                 # Fichiers à ignorer par Git
```

## 🚀 Technologies utilisées

| Technologie | Version | Rôle |
|-------------|---------|------|
| **PHP** | ≥ 7.4 | Langage serveur principal |
| **Symfony** | 4.x | Framework web MVC |
| **Composer** | Latest | Gestionnaire de dépendances |
| **Twig** | 3.x | Moteur de templates |
| **MySQL** | 8.x | Base de données |
| **Apache** | 2.4 | Serveur web |

## 🔧 Installation et utilisation

### Clonage du repository
```bash
# Cloner le repository dans le dossier web de Laragon
cd C:\laragon\www\
git clone [URL-DU-REPOSITORY] atelier-framework-web
cd atelier-framework-web
```

### Utilisation générale
```bash
# Naviguer vers un dossier de travail
cd [nom-du-dossier]/

# Installer les dépendances (si nécessaire)
composer install

# Lancer le serveur (si applicable)
php bin/console server:run
```

### Bonnes pratiques Git
```bash
# Créer une branche pour chaque travail
git checkout -b [nom-de-la-branche]

# Commit réguliers avec messages clairs
git add .
git commit -m "[Description des modifications]"

# Push vers le repository
git push origin [nom-de-la-branche]
```

## 📖 Ressources utiles

### Documentation officielle
- [Symfony Documentation](https://symfony.com/doc/4.4/index.html)
- [PHP Documentation](https://www.php.net/manual/fr/)
- [Twig Documentation](https://twig.symfony.com/doc/3.x/)

### Outils et liens
- [Laragon](https://laragon.org/) - Environnement de développement
- [Composer](https://getcomposer.org/) - Gestionnaire de dépendances PHP
- [Symfony CLI](https://symfony.com/download) - Outil en ligne de commande
- [Git](https://git-scm.com/) - Contrôle de version

### Communauté
- [Symfony Community](https://symfony.com/community)
- [Stack Overflow - Symfony](https://stackoverflow.com/questions/tagged/symfony)

## 👨‍🏫 Informations du cours
 
**Cours** : Atelier Framework Web côté serveur  
**Année universitaire** : 2025/2026  

## 📝 Notes importantes

- Chaque dossier de travail possède ses propres instructions détaillées
- Les projets sont configurés pour fonctionner avec Laragon (adaptation de XAMPP)
- Tous les codes sont commentés en français pour faciliter la compréhension
- Les captures d'écran et documentation sont organisées dans les dossiers appropriés

## 🤝 Contribution

Ce repository est à des fins éducatives. Les suggestions d'amélioration sont les bienvenues via les issues GitHub.

---

**Dernière mise à jour** : Septembre 2025  
**Version** : 1.0.0
