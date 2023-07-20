# Projet de gestion d'un garage - Garage Parrot
## Réalisé avec Symfony 6

![Symfony Version](https://img.shields.io/badge/Symfony-6.3-green)
![PHP Version](https://img.shields.io/badge/PHP-8.2-blue)

Ce projet est une application web de gestion de garage développée en utilisant le framework Symfony 6. L'objectif de cette application est de permettre aux employés du garage de gérer des annonces de voitures d'occasion, avec des fonctionnalités d'ajout, de modification et de suppression des annonces.

## Fonctionnalités

- Affichage des annonces de voitures avec pagination.
- Filtrage des annonces par prix minimum et maximum, kilomètre minimum et maximum et par année également.
- Ajout, modification et suppression des annonces.
- Système d'authentification pour les utilisateurs avec rôles (administrateur et employé).
- Interface d'administration pour gérer les annonces, les utilisateurs, les informations du garage etc...


## Prérequis

- PHP 8.0 ou version ultérieure
- Composer
- Symfony CLI
- MySQL (ou autre SGBD compatible)

## Installation

1. Vérifier si l'environnement est compatible avec Symfony en utilisant la commande dans votre terminal: ```bash symfony check:requirements```
2. Clonez le dépôt Git sur votre machine locale grâce à la commande: git clone https://github.com/Yskay91/garage-parrot-ECF.git
3. Installer les dépendances nécessaires via Composer
4. Configurez la base de données dans le fichier `.env` en spécifiant les paramètres de connexion à votre SGBD.
5. Créez la base de données et exécutez les migrations pour créer les tables. Pour cela utiliser les commandes suivantes :
    - ```bash php bin/console doctrine:database:create```
    - ```bash php bin/console doctrine:migrations:migrate```
6. Chargez les données de test grâce au fichier sql/insert.sql
7. Lancer le serveur Symfony en utilisant la commande: symfony serve
8. Il ne reste plus qu'à aller sur votre navigateur préféré en utilisant le lien fourni par la commande précédente.

## Auteurs
 Jessica Eisele [@Yskay91](https://github.com/Yskay91)