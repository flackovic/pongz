# Pongz project

## Setup:

- Clone repo

- Install dependencies (`composer install`)

- Setup env and DB params (`cp .env.dist .env`)

- Create database (`php bin/console doctrine:database:create`)

- Migrate database (`php bin/console doctrine:migrations:migrate`)

- Optional: seed dummy data (`php bin/console doctrine:fixtures:load`)

- Serve project (`php bin/console server:run`)

## Commands Cheatsheet:

#### Serve project:
`php bin/console server:run`

#### Run CS Fixer:
`./csfix.sh`

#### Run tests:
`php bin/phpunit`

#### Create test DB:
`php bin/console doctrine:database:create --env test`

#### Migrate test DB:
`php bin/console doctrine:migrations:migrate --env test`

#### Load fixtures in test DB:
`php bin/console doctrine:fixtures:load --env test`
