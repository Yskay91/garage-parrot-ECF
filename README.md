# Projet de gestion d'un garage - Garage Parrot

![Logo](https://garage-parrot.jessica-eisele.fr/images/logo.png)

## Développé avec Symfony 6.3

![Symfony Version](https://img.shields.io/badge/Symfony-6.3-green)
![PHP Version](https://img.shields.io/badge/PHP-8.2-blue)

Ce projet est une application web de gestion de garage développée en utilisant le framework Symfony 6. L'objectif de cette application est de permettre aux employés du garage de gérer des annonces de voitures d'occasion, avec des fonctionnalités d'ajout, de modification et de suppression des annonces.

## Fonctionnalités

- Affichage des annonces de voitures avec pagination.
- Filtrage des annonces par prix minimum et maximum, kilomètre minimum et maximum et par année également.
- Ajout, modification et suppression des annonces.
- Système d'authentification pour les utilisateurs avec rôles (administrateur et employé).
- Interface d'administration pour gérer les annonces, les utilisateurs, les informations du garage etc...

## Liens
- Site en ligne : https://garage-parrot.jessica-eisele.fr
- GitHub : https://github.com/Yskay91/garage-parrot-ECF.git
- Trello : https://trello.com/invite/b/1i7rmn0G/ATTIc44e8659b20fa03030ff10085994796282041631/garage-vparrot
- Figma :
https://www.figma.com/file/DVShv6ZaIOLahNMHDv5Bil/Garage-Parrot?type=design&node-id=0%3A1&mode=design&t=YW35ch1Ofk0kMLbd-1
- Excalidraw : https://excalidraw.com/#json=xsMd39G6DL1RfBahC_dO0,074mON8Ebn0RAfTBiqXzcQ

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
7. Lancer le serveur Symfony en utilisant la commande: ```bash symfony serve```
8. Il ne reste plus qu'à aller sur votre navigateur préféré en utilisant le lien fourni par la commande précédente.

## Création de l'employé administrateur
Pour insérer l’administrateur comme premier employé, je suis passée par le formulaire d’inscription (RegistrationType.php, accessible avec le paramètre d’url /inscription).

## Auteurs
 Jessica Eisele [@Yskay91](https://github.com/Yskay91)