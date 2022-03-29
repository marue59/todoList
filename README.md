# Projet 8 todoList

## Description of the project

- The ToDo & Co application needs to be upgraded

## Technologies and bundles :

- PHP 8.0.2
- Symfony 6
- Versionning with git
- Bundles :
  - symfony/security-bundle,
  - phpunit,
  - doctrine/doctrine-bundle,
  - fakerphp/faker.

## Installation

1. Clone the GitHub repository :
   https://github.com/marue59/todoList.git

2. Import bundles :

   ```
      composer install
   ```

3. Configure your environment :

   - Database : in .env
   - Create database

```
    php bin/console doctrine:database:create
```

- Make migration

```
   php bin/console doctrine:migrations:migrate
```

- Fixtures :

```
   php bin/console doctrine:fixtures:load
```

- default values : Roles user and admin are automatically created and passwords are : password

- Docker :
- Create the docker network

```
  docker network create todoList
```

- Launch the containers

```
    docker-composer up -d
```

- Enter the PHP container

```
    docker exec -ti [nom du container php] bash
```

- Install composer and these dependencies

```
    composer install
```

- Get out of the container

```
    exit
```

## Codacy :

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/95018b73e0834ef19fd0dcba88dadda5)](https://www.codacy.com/gh/marue59/todoList/dashboard?utm_source=github.com&utm_medium=referral&utm_content=marue59/todoList&utm_campaign=Badge_Grade)
