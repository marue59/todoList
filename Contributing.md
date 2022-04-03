# Contributing

## Source :

Vous trouverez les informations dans le Readme.md

- Clone the GitHub repository :
  https://github.com/marue59/todoList.git

## Installation du projet :

- Configurer vos variables d'environnement :

- Containers Docker en racine :

```
    cp .env.example .env
```

- URL de la base de données :

```
    cp app/html/vendor/.env app/html/vendor/.env.local app/html/vendor/.env.test
```

- Créer le reseau Docker :

```
    docker network create todoList
```

- Lancer les containers :

```
 	docker-composer up -d
```

- Entrer dans le container PHP pour lancer les commandes de la base de données :

```
docker exec -ti [nom du container php] bash

```

- Installer composer et ces dependances :

```
    composer install
```

- Installer Database :

```
    php bin/console doctrine:migrations:migrate
```

- Charger les fixtures :

```
    php bin/console doctrine:fixtures:load
```

- Sortir du container :

```
    exit
```

## Contribuer au projet :

Dans le but de proposer un code évolutif et compréhensible de tous, il vous sera demandé de respecter les standards de la programmation (soit les bonnes pratiques) :

- Le code doit respecter les normes PSR ( PSR-1, PSR-2, PSR-4 et PSR-12)

-> ressources : https://www.php-fig.org/psr/

- Le code doit être bien indenté et commenté afin d’optimiser la compréhension de chacun.

-> utilisation de : php-cs-fixer

- Pour la qualité de votre code doit obtenir au minimum un B.

-> codacy (ou Code Climate ou Symfony Insight)

- Pour la performance soumettre votre code à BlackFire contrôleur de performance.

- Il vous sera demandé pour chaque nouvelle fonctionnalité d’y apporter les tests correspondants afin de couvrir l’ensemble de votre code. (tests unitaires et tests fonctionnels).

- Vérifier que l’ensemble des tests soient au vert

-> php bin/phpunit

- Après chaque fonctionnalitée créée et testée, vous devrez versionner votre code sur Git en commitant sur votre branche : - git add . - git commit -m “description concis de la fonctionnalité” - git push origin nomdevotrebranche.

- Réaliser une Pull Request : - sur le repo du projet, cliquer sur New Pull Request. - comparer : main et nomdevotrebranche. - cliquer sur Merger la PR
