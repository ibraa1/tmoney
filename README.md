TMoney Project
Ce projet TMoney est une application de gestion de transactions financières en ligne. Il permet aux utilisateurs de réaliser des transferts d'argent, des retraits et des dépôts.

Fonctionnalités
Transfert d'argent entre utilisateurs
Retrait d'argent dans des points de service
Dépôt d'argent sur le compte utilisateur
Gestion des devises et des taux de change
Gestion des utilisateurs et de leurs rôles
Suivi des transactions effectuées
Calcul des commissions sur les transactions
Prérequis
Avant de pouvoir exécuter l'application TMoney, assurez-vous d'avoir installé les éléments suivants :

PHP 7.4 ou version supérieure
Composer
Laravel 8.x
MySQL 5.7 ou version supérieure
Installation
Clonez le projet à partir du dépôt Git :
git clone https://github.com/votre-utilisateur/tmoney.git
Accédez au répertoire du projet :
cd tmoney
Installez les dépendances du projet à l'aide de Composer :
composer install

Dupliquez le fichier .env.example et renommez-le en .env. Modifiez les informations de connexion à la base de données dans ce fichier en fonction de votre environnement.

Générez la clé d'application Laravel :
php artisan key:generate
Exécutez les migrations de la base de données et les seeders :
php artisan migrate --seed
Démarrez le serveur de développement :
php artisan serve
Accédez à l'application dans votre navigateur à l'adresse http://localhost:8000.
Contribution
Si vous souhaitez contribuer à ce projet, vous pouvez suivre ces étapes :

Fork le projet depuis le dépôt Git.
Clonez votre fork vers votre machine locale.
Créez une branche pour vos modifications.
Effectuez les modifications et ajoutez-les.
Envoyez vos modifications vers votre fork.
Ouvrez une Pull Request dans le dépôt d'origine.
Auteurs
Votre Nom (@ibraa1)
Autre Contributeur (@thierno)
Licence
Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.
