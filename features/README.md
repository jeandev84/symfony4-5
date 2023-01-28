### Features

1. Installation packages
```
$ composer require twig
$ composer require doctrine
$ composer require maker
$ composer require orm
$ composer require logger
$ composer require logger -W [ flag (-W) resolve dependencies ]
$ composer require symfony/asset
$ composer require symfony/web-profiler-bundle
```


2. Maker 
```
$ bin/console make:controller
$ bin/console make:entity
$ bin/console make:migration
$ bin/console doctrine:migrations:migrate
$ bin/console cache:clear
```


3. Debug 
```
$ bin/console debug:container
```

4. Binding Services To Controller 
```
# add more service definitions when explicit configuration is needed
# please note that last definitions always *replace* previous ones
App\Controller\DemoController:
    bind:
      $logger: '@monolog.logger.doctrine'
```

5. Webpack Encore
```
$ composer require symfony/webpack-encore-bundle

OR

$ npm init
$ npm install @symfony/webpack-encore --save-dev
$ npm install --save jquery
$ npm install webpack-notifier@^1.15.0 --save-dev
$ npm run build || ./node_modules/.bin/encore production
$ npm run watch || npm run dev || ./node_modules/.bin/encore dev --watch
$ yarn encore dev-server
```


6. Security Bundle package
```
$ composer require symfony/security-bundle
```


7. Doctrine CRUD 
```
$ composer require orm-fixtures --dev
$ bin/console make:fixtures (Make UserFixtures)
$ bin/console list doctrine (List all commands of doctrine)

$ bin/console doctrine:schema:drop -n -q --force --full-database
$ rm ./migrations/*.php
$ bin/console make:migration
$ bin/console doctrine:migrations:migrate
$ bin/console doctrine:fixtures:load [IF HAS FIXTURES]
 Careful, database "main" will be purged. Do you want to continue? (yes/no) [no]:
 > yes

   > purging database
   > loading App\DataFixtures\AppFixtures
   > loading App\DataFixtures\UserFixtures

==============================================================================
                    OR ONE LINE :
==============================================================================

$ bin/console doctrine:schema:drop -n -q --force --full-database
  & rm ./migrations/*.php
  & bin/console make:migration
  & bin/console doctrine:migrations:migrate
  & bin/console doctrine:fixtures:load
```


8. Framework Extra Bundle 
```
$ composer require sensio/framework-extra-bundle
```