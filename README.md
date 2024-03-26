# Usage

## Create database and fixtures

```sh
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
```

## Run tests

```sh
bin/phpunit
```

Set `doctrine.orm.enable_lazy_ghost_objects` to `false` in config/packages/doctrine.yaml and run `bin/phpunit` again to test the working behavior without lazy ghost objects.
