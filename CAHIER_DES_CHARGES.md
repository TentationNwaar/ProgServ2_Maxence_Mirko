# Cahier des charges

## 1. Équipe

Weyermann Maxence & Martone Mirko

## 2. Présentation du projet

Dans le monde du football, il y a énormément de compétitions et de matchs
différents toutes les semaines, et il arrive souvent qu'en tant que fan qui
supporte plusieurs équipes ou simplement par envie de vouloir suivre des matchs
on se sente un peu submergé par les différentes compétitions. Notre objectif est
de tout centraliser pour voir les matchs, donner son avis, suivre d'autres
personnes et bien plus encore.

## 3. Fonctionnalités principales

- Inscription, connexion, déconnexion (e-mail + mot de passe)
- Modification du profil (bio, équipes favorites)
- Liste des matchs du jour et page d'un match
- Noter un match et écrire une review
- Journal personnel : historique des matchs notés
- Liste "à regarder"
- Rôle administrateur : ajouter et modifier les matchs
- Deux langues (français, anglais)
- Envoi d'un e-mail (par exemple un e-mail de bienvenue à l'inscription)
- Les matchs sont ajoutés par l'administrateur et un jeu de données de test est
  fourni dans un fichier SQL.

## 4. Fonctionnalités optionnelles

- Calendrier pour parcourir les jours
- Onglet "populaires"
- Suivre un autre utilisateur, feed d'activité
- Liker et commenter une review
- Photo de profil

## 5. Utilisateurs et rôles

| Action                                 | Visiteur | Utilisateur | Administrateur |
| :------------------------------------- | :------: | :---------: | :------------: |
| Voir la liste des matchs du jour       |   Oui    |     Oui     |      Oui       |
| Voir la page d'un match et ses reviews |   Oui    |     Oui     |      Oui       |
| Créer un compte / se connecter         |   Oui    |     Non     |      Non       |
| Noter un match et écrire une review    |   Non    |     Oui     |      Oui       |
| Consulter son journal personnel        |   Non    |     Oui     |      Oui       |
| Gérer sa liste "à regarder"            |   Non    |     Oui     |      Oui       |
| Modifier son profil                    |   Non    |     Oui     |      Oui       |
| Ajouter / modifier un match            |   Non    |     Non     |      Oui       |

**Pages publiques** (accessibles sans connexion) :

- Liste des matchs du jour (accueil)
- Page d'un match et de ses reviews
- Inscription
- Connexion

**Pages privées** (accessibles après connexion) :

- Journal personnel
- Liste "à regarder"
- Modification du profil
- Écriture d'une review
- Gestion des matchs (administrateur uniquement)
- Profil personnel

## 6. Contexte

Ce projet est réalisé dans le cadre des études à la HEIG-VD, dans le cours
Programmation serveur 2 (ProgServ2). Il est développé en PHP sans framework
externe, avec une base de données MySQL/MariaDB.

Une IA (Claude) a été utilisée le 28.09.2026 pour relire le document. Nous avons
rédigé le contenu et pris les décisions nous-mêmes.
