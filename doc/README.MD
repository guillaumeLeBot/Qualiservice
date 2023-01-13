## Application livraison/expédition
> Cette application à pour but de faciliter la réception et l'expédition de la marchandise par camion au sein de la société Qualiservice.
### Architecture du projet
> Ce projet est codé en php 8 via le framework Symfony dans sa version 6, pour des raisons de portabilités ce projet est "contenairisé" via docker , les dossiers et fichiers docker ne sont pas versionné pour des raisons de clarté du code.
### Mise en place du projet
>Afin de mettre en place de façon fonctionnel ce projet en local sur votre poste suivez les étapes suivantes :
>- Suivre la documentation sur ce lien (https://github.com/guillaumeLeBot/env-project).
>- Créer un dossier "app".
>- Cloner ce repository dans le dossier "app".
>- Changer les variables d'environnement.
>- Lancer les containers docker via docker-compose.
>- Dans le container php lancer la commande "composer install"
### Si le dossier "migration" est vide
>- Creer les migrations avec la commande "symfony console make:migration"
### Dans tous les cas
>- Lancer les migrations avec la commande "symfony console doctrine:migration:migrate"
### Enjoy :)