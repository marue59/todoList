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
     `php bin/console doctrine:database:create`
   - Make migration
     `php bin/console doctrine:migrations:migrate`
   - Fixtures :
     `php bin/console doctrine:fixtures:load`
   - default values : Roles user and admin are automatically created and passwords are : password

   - Docker :
   - Create the docker network
     `docker network create project8`
   - Launch the containers
     `docker-composer up -d`
   - Enter the PHP container
     `docker exec -ti [nom du container php] bash`
