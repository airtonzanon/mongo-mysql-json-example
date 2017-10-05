# Doctrine Migrations

Doctrine migrations for Mysql Database, Mongo Database and import scripts.

This will help with CD and rollback in case of "bad deploy"

## Running project

- Run composer install|updade
- Check **migration/migrations-db.php** with mysql database configs
- Check **migration/migrations.yml** with migration projet configs

## Command

We have a console.php in order to run commands and check migrations status

Default console:
``` php migration/console.php ```

Check commands
``` php migration/console.php list ```

Check Migrations state
``` php migration/console.php status ```

Create a new migration file
``` php migration/console.php generate ```

Run all the migrations
``` php migration/console.php migrate ```

@todo: use schema to create and populate a initial database

## File doctrine.php

This file has some examples using DBAL, pure SQL and the Schema Object