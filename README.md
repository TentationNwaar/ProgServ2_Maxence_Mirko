# HEIG-VD ProgServ2 Course PHP Template

Ce modèle de projet est conçu pour les étudiant.es du cours
[_"Programmation Serveur 2 (ProgServ2)"_](https://github.com/heig-vd-progserv-course/heig-vd-progserv2-course)
à la [HEIG-VD](https://heig-vd.ch).

Il fournit une structure de base pour les projets PHP avec les éléments suivants
:

- Un serveur [Apache](https://httpd.apache.org/) avec
  [PHP 8.5](https://www.php.net/) et les extensions nécessaires pour se
  connecter à une base de données [MariaDB](https://mariadb.org/).
- Une base de données [MariaDB](https://mariadb.org/) préconfigurée avec un
  utilisateur et un mot de passe par défaut. Dans vos scripts PHP, utilisez le
  nom d'hôte `mariadb` et les identifiants définis dans le fichier
  `compose.yaml`.
- Une interface web [phpMyAdmin](https://www.phpmyadmin.net/) pour gérer la base
  de données MariaDB en utilisant les mêmes identifiants que ceux définis dans
  le fichier `compose.yaml`.
- Un serveur SMTP [Mailpit](https://mailpit.axllent.org/) pour tester l'envoi
  d'e-mails depuis votre application PHP.
- Des configurations recommandées pour l'éditeur de code
  [Visual Studio Code](https://code.visualstudio.com/), y compris des extensions
  utiles pour le développement PHP et la gestion de bases de données
  ([PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client),
  [Prettier](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode),
  [SQLite Viewer](https://marketplace.visualstudio.com/items?itemName=qwtel.sqlite-viewer)).

Tous ses éléments sont configurés pour fonctionner avec
[Docker Compose](https://docs.docker.com/compose/), ce qui permet de créer un
environnement de développement isolé et reproductible.

N'hésitez pas à personnaliser ce modèle et ce document pour ajouter des
instructions spécifiques à votre projet ou des détails supplémentaires sur la
configuration et l'utilisation du projet.

## Utiliser ce modèle pour votre projet

1. Cliquez sur le bouton "Use this template" (Utiliser ce modèle) sur la page
   GitHub de ce dépôt.
2. Donnez un nom à votre nouveau dépôt et configurez les options selon vos
   préférences.
3. Invitez les membres de votre équipe à collaborer sur le projet en leur
   donnant accès au dépôt (si applicable).
4. Chaque membre de l'équipe doit cloner le nouveau dépôt sur sa machine locale
   pour commencer à travailler sur le projet.
5. Utilisez le workflow GitHub étudié en cours pour gérer les branches, les
   commits et les pull requests afin de collaborer efficacement sur le projet.

## Structure du projet

- `.devcontainer/`: Contient la configuration pour le développement dans un
  conteneur Debian (Trixie) avec Visual Studio Code.
- `.vscode/`: Contient les paramètres recommandés pour Visual Studio Code.
- `.gitignore`: Fichier de configuration pour Git, spécifiant les fichiers et
  dossiers à ignorer.
- `compose.yaml`: Fichier de configuration pour Docker Compose, définissant les
  services nécessaires pour le projet, avec :
  - [Apache](https://httpd.apache.org/) : Serveur web pour exécuter les fichiers
    PHP.
  - [MariaDB](https://mariadb.org/) : Base de données relationnelle.
  - [phpMyAdmin](https://www.phpmyadmin.net/) : Interface web pour gérer la base
    de données MariaDB.
  - [Mailpit](https://mailpit.axllent.org/) : Serveur SMTP pour tester l'envoi
    d'e-mails.
- `index.php`: Fichier PHP principal du projet.
- `script.sql`: Fichier SQL pour créer la table `my_table` dans la base de
  données.
- `README.md`: Ce fichier de documentation.

## Ouvrir le projet localement

> [!NOTE]
>
> Il est important d'ouvrir le dossier du projet directement et non un dossier
> parent.
>
> Pensez à bien ouvrir le dossier du projet lui-même (celui qui contient ce
> fichier README.md) et non un dossier parent. Ouvrir un dossier parent peut
> entraîner des problèmes de configuration et de fonctionnement de Visual Studio
> Code.

1. Clonez ce dépôt sur votre machine locale.
2. Ouvrez ce dossier dans Visual Studio Code.

## Ouvrir le projet dans un conteneur de développement

Si vous avez l'extension
[Dev Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)
installée, Visual Studio Code vous proposera d'ouvrir le projet dans un
conteneur Docker.

Acceptez cette proposition pour bénéficier d'un environnement de développement
préconfiguré.

Si aucune notification n'apparaît, vous pouvez ouvrir manuellement le conteneur
en utilisant la commande _"Dev Containers: Reopen in Container"_ dans la palette
de commandes (<kbd>Ctrl</kbd>+<kbd>Shift</kbd>+<kbd>P</kbd> sur Windows/Linux ou
<kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>P</kbd> sur macOS).

## Démarrer les services Docker

Pour démarrer les services Docker nécessaires à développer des applications PHP,
ouvrez un terminal intégré dans Visual Studio Code et exécutez la commande
suivante :

```bash
# Démarre tous les services définis dans le fichier compose.yaml
docker compose up
```

Ceci va démarrer les services suivants dans des conteneurs Docker :

- Apache (port 8080) : Serveur web pour exécuter les fichiers PHP.
- MariaDB (port 3306) : Base de données relationnelle.
- phpMyAdmin (port 9090) : Interface web pour gérer la base de données MariaDB.
- Mailpit (ports 1025 et 8025) : Serveur SMTP pour tester l'envoi d'e-mails.

## Se connecter à la base de données MariaDB avec phpMyAdmin

La configuration Docker Compose inclut également phpMyAdmin, un outil web pour
gérer les bases de données MariaDB.

Pour accéder à phpMyAdmin, ouvrez votre navigateur et rendez-vous à l'adresse
suivante : <http://localhost:9090>.

Vous pourrez alors vous connecter à la base de données en utilisant les
identifiants décrits dans le fichier `compose.yaml` (par défaut, l'utilisateur
est `username` et le mot de passe est `password`).

## Exécuter des requêtes SQL sur la base de données MariaDB

Une fois connecté à la base de données MariaDB via phpMyAdmin, vous pouvez
exécuter des requêtes SQL pour créer des tables, insérer des données ou
effectuer d'autres opérations sur la base de données.

1. Ouvrez/créez un fichier SQL dans Visual Studio Code (par exemple,
   `script.sql`).
2. Écrivez votre requête SQL dans ce fichier (par exemple, une requête pour
   créer une table ou insérer des données).
3. Dans l'onglet "SQL" de phpMyAdmin, vous pouvez copier et coller votre requête
   SQL depuis le fichier `script.sql` et l'exécuter pour appliquer les
   modifications à la base de données.

## Voir les données de la table `my_table`

Une fois le ou les scripts SQL exécutés, vous pouvez vérifier que les données
ont été correctement insérées dans la table `my_table` dans le menu latéral
gauche de phpMyAdmin. Cliquez sur le nom de la base de données, puis sur le nom
de la table pour voir les données.

## Exécuter vos scripts PHP

La configuration Docker Compose inclut un serveur web Apache avec PHP, ce qui
vous permet d'exécuter vos scripts PHP directement dans le conteneur.

Le serveur sera accessible à l'adresse <http://localhost:8080> dans votre
navigateur.

La liste des fichiers PHP disponibles sera affichée, et vous pourrez cliquer sur
un fichier pour l'exécuter.

Les scripts PHP peuvent se connecter à la base de données MariaDB en utilisant
le nom d'hôte `mariadb` et les identifiants définis dans le fichier
`compose.yaml`.

En accédant à l'adresse <http://localhost:8080/public/index.php>, vous pourrez
exécuter le script PHP principal du projet.

La page d'accueil de démonstration affiche un message de bienvenue et utilise la
base de données MariaDB pour afficher les données de la table `my_table`.

## Visualiser les e-mails envoyés par votre application PHP

Le serveur SMTP Mailpit est inclus dans la configuration Docker Compose pour
vous permettre de tester l'envoi d'e-mails depuis votre application PHP.

Pour accéder à l'interface web de Mailpit, ouvrez votre navigateur et
rendez-vous à l'adresse suivante : <http://localhost:8025>.

Vous y verrez la liste des e-mails envoyés par votre application PHP, ainsi que
leur contenu et les détails de l'envoi.

Si vous fermez/redémarrez Mailpit, les e-mails précédemment envoyés seront
perdus, car ils ne sont pas stockés de manière persistante.

## Arrêter les services Docker

Si vous avez exécuté la commande `docker compose up` pour démarrer les services
Docker, vous pouvez les arrêter avec le raccourci clavier
<kbd>Ctrl</kbd>+<kbd>C</kbd> dans le terminal où la commande a été exécutée.
Cela arrêtera les services et libérera les ressources utilisées par les
conteneurs Docker.

Sinon, vous pouvez également arrêter les services Docker en ouvrant un terminal
intégré dans Visual Studio Code et en exécutant la commande suivante :

```bash
# Arrête tous les services définis dans le fichier compose.yaml
docker compose down
```

Lorsque vous fermez Visual Studio Code, les conteneurs Docker seront
automatiquement arrêtés. Dès que vous rouvrez Visual Studio Code et que vous
exécutez à nouveau la commande `docker compose up`, les services Docker seront
redémarrés.

# Lien du site

https://fulltimed.ch/

# Cahier des charges

## 1. Équipe

Weyermann Maxence & Martone Mirko

## 2. Présentation du projet

Dans le football, il existe de nombreuses applications pour suivre son équipe,
suivre les matchs, s'informer ou noter les joueurs lors d'une rencontre. En
revanche, il n'existe pas réellement d'application communautaire permettant de
noter les matchs et de garder une trace de ceux qu'on a regardés, en particulier
ceux qui nous ont fait vibrer.

L'aspect communautaire est lui aussi limité : à part les réseaux sociaux
traditionnels, il n'existe pas d'espace dédié pour discuter des matchs, des
équipes, etc.

Fulltimed répond à ce besoin. L'application permet de :

- garder une trace des matchs regardés ;
- noter les matchs et les commenter ;
- ajouter des matchs à une liste « à voir » ;
- interagir avec les autres utilisateurs autour des matchs, dans une logique
  communautaire.

## 3. Fonctionnalités principales

### Authentification

- Inscription, connexion, déconnexion (e-mail + mot de passe)

### Page d'accueil

- Aperçu des matchs principaux
- Un bouton « Voir plus » redirige vers la page Matchs

### Page Matchs

- Matchs du jour
- Filtre par compétition
- Calendrier

### Page d'un match

- Informations utiles : description, stade, classement, forme des équipes
- Actions : noter le match, l'ajouter à la liste « à regarder », le mettre en
  favori, le commenter
- Avis de la communauté et note moyenne

### Page Communauté

- Derniers posts de la communauté sur différents matchs
- Chaque post contient : nom d'utilisateur, note du match, match concerné,
  commentaire
- Posts des amis
- Clic sur un nom d'utilisateur pour accéder à son profil
- Possibilité de répondre à un post et de le liker

### Profil personnel

- Liste des matchs à regarder
- Historique des matchs notés
- Liste des matchs commentés
- Matchs préférés (favori)
- Équipes préférées
- Bio, nom d'utilisateur, adresse e-mail
- Bouton de modification du profil (bio, équipes favorites, nom d'utilisateur)

### Profil d'un autre utilisateur (ami)

- Liste des matchs à regarder
- Derniers matchs vus
- Liste des matchs commentés
- Équipes préférées
- Bio, nom d'utilisateur
- Bouton « Ajouter en ami »
- Matchs préférés (favori)

### Rôle administrateur

- Ajout et modification des matchs
  - Bouton « Ajouter un match » dans la page Matchs
  - Formulaire d'ajout prédéfini, il suffit de remplir les informations
- Modération : suppression de commentaires, suppression d'utilisateurs

### Autres

- Deux langues (français, anglais)
- Envoi d'un e-mail (ex. e-mail de bienvenue à l'inscription)
- Les matchs sont ajoutés par l'administrateur ; un jeu de données de test est
  fourni dans un fichier SQL

## 4. Utilisateurs et rôles

| Action                                                       | Visiteur | Utilisateur | Administrateur |
| :----------------------------------------------------------- | :------: | :---------: | :------------: |
| Créer un compte / se connecter                               |   Oui    |     Non     |      Non       |
| Voir la page d'accueil et les matchs du jour                 |   Oui    |     Oui     |      Oui       |
| Voir la page d'un match, sa note moyenne et ses commentaires |   Oui    |     Oui     |      Oui       |
| Noter et commenter un match                                  |   Non    |     Oui     |      Oui       |
| Ajouter un match à sa liste « à regarder »                   |   Non    |     Oui     |      Oui       |
| Consulter son profil et son historique                       |   Non    |     Oui     |      Oui       |
| Modifier son profil                                          |   Non    |     Oui     |      Oui       |
| Voir la page Communauté et les profils des autres            |   Non    |     Oui     |      Oui       |
| Liker / répondre à un post                                   |   Non    |     Oui     |      Oui       |
| Ajouter un utilisateur en ami                                |   Non    |     Oui     |      Oui       |
| Ajouter / modifier un match                                  |   Non    |     Non     |      Oui       |
| Supprimer un commentaire ou un utilisateur                   |   Non    |     Non     |      Oui       |

**Pages publiques** (accessibles sans connexion) :

- Page d'accueil (aperçu des matchs principaux)
- Page Matchs (matchs du jour, filtre par compétition, calendrier)
- Page d'un match (infos, note moyenne, commentaires de la communauté)
- Inscription
- Connexion

**Pages privées** (accessibles après connexion) :

- Profil personnel (historique des matchs notés, liste « à regarder », matchs
  commentés)
- Modification du profil
- Page Communauté
- Profil d'un autre utilisateur
- Notation et commentaire d'un match (depuis la page du match)

**Pages réservées à l'administrateur** :

- Formulaire d'ajout / modification d'un match
- Modération (suppression de commentaires et d'utilisateurs)

## 6. Contexte

Ce projet est réalisé dans le cadre des études à la HEIG-VD, dans le cours
Programmation serveur 2 (ProgServ2). Il est développé en PHP sans framework
externe, avec une base de données MySQL/MariaDB.

## Maquettes

Les maquettes sont disponibles sous deux formes :

- **Basse fidélité** (wireframes) : dossier
  [`Maquette/basse-fidelite/`](Maquette/basse-fidelite/), 14 écrans.
- **Haute fidélité** : dossier
  [`Maquette/haute-fidelite/`](Maquette/haute-fidelite/), 13 écrans exportés
  depuis Figma (accueil, matchs, fiche d'un match, connexion, inscription,
  communauté, journal, profil d'un ami, ma liste, historique, ajout /
  modification d'un match et modération).

Lien vers la maquette haute fidélité sur Figma :
<https://www.figma.com/design/gfWI3bEz3JeoRwZAvLp2xS/Test?node-id=23-2>

## Utilisation de l'IA

Nous avons utilisé l'IA Claude (Anthropic) comme outil d'aide et d'explication.
Certaines parties du code ont aussi été générées par l'IA, puis relues et
corrigées par nous. Les usages sont détaillés ci-dessous, par étape.

### Cahier des charges

Le 28.09.2026, nous avons demandé à Claude de relire le document et de nous
aider à compléter les sections 5 et 6. Il a proposé le tableau des rôles et les
actions de l'administrateur. Nous les avons relus et modifiés. Nous l'avons fait
pour vérifier que le cahier des charges était cohérent avec les consignes.

### Maquettes

Le 06.10.2026, Maxence a demandé à Claude ce qu'il manquait sur nos maquettes
par rapport au cahier des charges, et nous avons fait un brainstorming avec lui
pour les concevoir. Nous l'avons fait pour nous assurer que chaque
fonctionnalité avait une page.

Le 01.11.2026, Mirko a demandé à Claude de réaliser la version haute fidélité de
la maquette Figma à partir de notre wireframe (voir la section « Maquettes »).

### MCD / MLD

Le 12.10.2026, Claude nous a aidés à vérifier le MCD et le MLD (liaisons,
attributs, normalisation). Nous avons mis en lien ce que nous avions appris au
cours de base de données l'année dernière et dans ce cours. Après plusieurs
questions et doutes, l'IA a répondu à nos interrogations, et nous avons pris
nous-mêmes les décisions finales. À la suite de ces échanges, le modèle a changé
sur les points suivants :

- Suivi entre utilisateurs à sens unique (comme sur Letterboxd) plutôt qu'une
  amitié réciproque.
- Correction de plusieurs cardinalités et attributs du MCD.
- Normalisation au stade du MLD : tables `pays`, `role` et `type_equipe`.
- Les tables de jointure gardent leur propre `id`, avec une contrainte UNIQUE
  sur la paire de clés étrangères, pour empêcher par exemple de mettre deux fois
  le même match en favori.
- `a_regarder` et `favori` restent deux tables séparées, malgré leur structure
  identique.
- Les champs scores, commentaire et pays d'une compétition peuvent être vides.
- L'IA a confirmé que certaines règles ne s'expriment pas dans le MLD et doivent
  être gérées par des CHECK ou en PHP : équipe à domicile différente de l'équipe
  extérieure, note entre 0 et 5, interdiction de se suivre soi-même.

Les tables `categorie` et `stade` ont été retirées ensuite, à la suite du retour
du professeur et non de l'IA.

### Script SQL (MPD)

Mi-octobre, Mirko a demandé à Claude de générer une première version de
`script.sql` à partir de notre MLD. L'IA l'a testée sur une base MariaDB
(contraintes CHECK, UNIQUE, clés étrangères, ON DELETE CASCADE) et a apporté
deux corrections : le comportement à la suppression d'une catégorie, et le
constat que l'interdiction de se suivre soi-même doit être vérifiée en PHP. Elle
a aussi expliqué l'erreur #1044 dans phpMyAdmin (droits sur la base
`my_database`).

Le 28.10.2026, l'IA a adapté ce script au nouveau MLD (suppression des tables
`categorie` et `stade` et de leurs clés étrangères, ajout d'un en-tête
`DROP TABLE` pour pouvoir le réimporter).

### Git et environnement de développement

À certains moments du projet entre le 12.10.2026 et le 02.11.2026, nous avons
rencontré des erreurs avec Docker (`read-only file system`) et Git
(`dubious ownership`, push sur `main` sans pull request). Claude nous a expliqué
les causes et les commandes à utiliser, que nous avons appliquées nous-mêmes.
Nous l'avons fait pour débloquer notre environnement et comprendre le workflow
des pull requests.

### Déploiement

Les 27 et 28.10.2026, nous avons demandé à Claude de nous expliquer les offres
d'Infomaniak et les étapes de déploiement, car nous avions des soucis avec
l'offre étudiante. Nous l'avons fait pour mettre le site en ligne avant
l'expiration de l'hébergement étudiant. Le 28.10.2026, Mirko a aussi demandé à
l'IA de corriger des erreurs dans `index.php` (configuration de la base, balise
`<?php` en double, requête restée du modèle du cours).

### Code PHP

Les 02 et 03.11.2026, Mirko a demandé à Claude de générer la structure HTML/PHP
de la page d'accueil (`index.php`) et de la page d'un match (`match.php`), avec
des données temporaires en tableaux PHP. Nous avons complété à deux les classes
`Database`, `FootballMatch`, `MatchManager`, `AvisManager`,
`CompetitionManager`, `bootstrap.php`, les requêtes SQL et le CSS puis optimisé
et relu le tout avec Claude.

### Suivi du projet

Le 04.11.2026, nous avons demandé à Claude d'analyser le dépôt pour lister ce
qui était fait et ce qui manquait. Nous nous sommes servis de cette liste pour
répartir le travail.
