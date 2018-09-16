# Pongz project

## Commands Cheatsheet:

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
