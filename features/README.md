### Features

1. Installation packages
```
$ composer require twig
$ composer require doctrine
$ composer require maker
$ composer require orm
$ composer require logger
$ composer require logger -W [ flag (-W) resolve dependencies ]
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