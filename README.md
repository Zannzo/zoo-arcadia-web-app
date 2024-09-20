# zoo-arcadia-web-app
Projet ECF

Bienvenue dans le projet Zoo Arcadia. Ce guide vous expliquera comment installer et lancer l'application en local. C'est un projet sympa pour gérer un zoo avec des fonctionnalités pour les employés, vétérinaires, et l'administrateur.

Prérequis
Avant de démarrer, assurez-vous d'avoir ces outils installés sur votre machine :

PHP (version 7.4 ou supérieure)
Composer (pour gérer les dépendances PHP)
MySQL ou tout autre système de gestion de base de données compatible
Un serveur web local comme XAMPP, WAMP ou MAMP selon votre OS
Étapes pour l'installation
1. Cloner le projet
La première étape est de cloner le projet depuis GitHub. Pour ça, ouvrez un terminal (ou Git Bash) et tapez la commande suivante :

git clone https://github.com/mon-utilisateur/zoo-arcadia.git

Remplacez mon-utilisateur par votre nom d'utilisateur GitHub, si nécessaire.

2. Configurer la base de données
Ouvrez phpMyAdmin ou tout autre outil pour gérer MySQL.
Créez une nouvelle base de données appelée zoo_arcadia.

CREATE DATABASE zoo_arcadia;

Importez le fichier base_de_donnees.sql dans cette nouvelle base de données. Ce fichier contient toutes les tables nécessaires et quelques données de test.

3. Configuration de l'application
Ensuite, allez dans le fichier connexion_bdd.php. Ce fichier gère les connexions à la base de données. Modifiez-le en fonction de votre configuration locale :

$host = 'localhost';
$dbname = 'zoo_arcadia';
$username = 'root';  // Votre nom d'utilisateur MySQL
$password = '';  // Laissez vide si vous n'avez pas de mot de passe

4. Lancer le serveur local
Si vous utilisez XAMPP, WAMP ou MAMP, déplacez le projet dans le dossier htdocs (ou www pour WAMP). Ensuite, lancez le serveur Apache et MySQL à partir du panneau de contrôle de votre environnement de serveur local.

5. Accéder à l'application
Ouvrez votre navigateur et accédez à l'URL suivante :

http://localhost/zoo_arcadia/index.php

L'application devrait s'afficher et être prête à l'emploi !

6. Identifiants de test
Pour tester l'application, vous pouvez utiliser les identifiants suivants en fonction des rôles :

Admin :
Nom d'utilisateur : admin
Mot de passe : admin
Employé :
Nom d'utilisateur : employe1
Mot de passe : employe
Vétérinaire :
Nom d'utilisateur : veterinaire1
Mot de passe : veterinaire
Vous pouvez aussi créer de nouveaux utilisateurs depuis l'interface admin, selon vos besoins.


