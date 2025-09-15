# Atelier Framework Web côté serveur - AU 2025/2026

Ce repository contient l'ensemble des travaux pratiques (TP) réalisés dans le cadre du cours **Atelier Framework Web côté serveur** dispensé par **Abdellatif Linda** pendant l'année universitaire 2025/2026.

## 📋 Table des matières

- [Vue d'ensemble](#vue-densemble)
- [Prérequis techniques](#prérequis-techniques)
- [Configuration de l'environnement](#configuration-de-lenvironnement)
- [Structure du repository](#structure-du-repository)
- [TPs réalisés](#tps-réalisés)
- [Technologies utilisées](#technologies-utilisées)
- [Installation et utilisation](#installation-et-utilisation)
- [Ressources utiles](#ressources-utiles)

## 🎯 Vue d'ensemble

Ce repository documente l'apprentissage des frameworks web côté serveur, avec un focus principal sur **Symfony 4**. Chaque TP explore différents aspects du développement web moderne, depuis l'initiation jusqu'aux concepts avancés.

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
4. Suivre les instructions spécifiques de chaque TP

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
├── TP1-initiation/             # Premier TP - Installation et configuration
│   ├── README.md               # Instructions spécifiques au TP1
│   ├── sf4/                    # Projet Symfony créé
│   └── documentation/          # Notes et captures d'écran
├── TP2-[nom-du-tp]/           # Deuxième TP
│   ├── README.md
│   ├── src/
│   └── documentation/
├── TP3-[nom-du-tp]/           # Troisième TP
├── ...                        # Autres TPs
├── resources/                 # Ressources communes
│   ├── docs/                  # Documentation générale
│   ├── templates/             # Templates réutilisables
│   └── assets/                # Images, CSS communs
└── .gitignore                 # Fichiers à ignorer par Git
```

## 📚 TPs réalisés

### ✅ TP1 - Initiation
**Objectif** : Installation et configuration de l'environnement Symfony
- [x] Installation de Laragon
- [x] Configuration de Composer
- [x] Création du premier projet Symfony
- [x] Test du serveur intégré

**Status** : Terminé ✅  
**Dossier** : [`TP1-initiation/`](./TP1-initiation/)

### 🔄 TP2 - [À compléter]
**Objectif** : [Sera mis à jour lors du prochain TP]
- [ ] [Objectifs à définir]

**Status** : En attente 🔄  
**Dossier** : [`TP2-[nom]/`](./TP2-[nom]/)

### ⏳ TPs suivants
Les prochains TPs seront ajoutés au fur et à mesure du semestre.

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

### Utilisation d'un TP spécifique
```bash
# Naviguer vers un TP
cd TP1-initiation/

# Installer les dépendances
composer install

# Lancer le serveur (si applicable)
php bin/console server:run
```

### Bonnes pratiques Git
```bash
# Créer une branche pour chaque TP
git checkout -b tp2-[nom-du-tp]

# Commit réguliers avec messages clairs
git add .
git commit -m "TP2: Implémentation du contrôleur principal"

# Push vers le repository
git push origin tp2-[nom-du-tp]
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

**Professeur** : Abdellatif Linda  
**Cours** : Atelier Framework Web côté serveur  
**Année universitaire** : 2025/2026  
**Institution** : [Nom de l'université/école]

## 📝 Notes importantes

- Chaque TP possède son propre README avec les instructions détaillées
- Les projets sont configurés pour fonctionner avec Laragon (adaptation de XAMPP)
- Tous les codes sont commentés en français pour faciliter la compréhension
- Les captures d'écran et documentation sont dans le dossier `documentation/` de chaque TP

## 🤝 Contribution

Ce repository est à des fins éducatives. Les suggestions d'amélioration sont les bienvenues via les issues GitHub.

---

**Dernière mise à jour** : Septembre 2025  
**Version** : 1.0.0
