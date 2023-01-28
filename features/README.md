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

$ bin/console doctrine:schema:drop -n -q --force --full-database &
  rm ./migrations/*.php &
  bin/console make:migration
   
$ bin/console doctrine:migrations:migrate
$ bin/console doctrine:fixtures:load
```


8. Framework Extra Bundle 
```
$ composer require sensio/framework-extra-bundle
```


9. Doctrine Relationships (OneToMany and ManyToOne)
```
$ bin/console make:entity Video
================================================================================

 created: src/Entity/Video.php
 created: src/Repository/VideoRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > title

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Video.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > user

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > User

What type of relationship is this?
 ------------ ----------------------------------------------------------------- 
  Type         Description                                                      
 ------------ ----------------------------------------------------------------- 
  ManyToOne    Each Video relates to (has) one User.                            
               Each User can relate to (can have) many Video objects            
                                                                                
  OneToMany    Each Video can relate to (can have) many User objects.           
               Each User relates to (has) one Video                             
                                                                                
  ManyToMany   Each Video can relate to (can have) many User objects.           
               Each User can also relate to (can also have) many Video objects  
                                                                                
  OneToOne     Each Video relates to (has) exactly one User.                    
               Each User also relates to (has) exactly one Video.               
 ------------ ----------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Video.user property allowed to be null (nullable)? (yes/no) [yes]:
 > 

 Do you want to add a new property to User so that you can access/update Video objects from it - e.g. $user->getVideos()? (yes/no) [yes]:
 > 

 A new property will also be added to the User class so that you can access the related Video objects from it.

 New field name inside User [videos]:
 > 

 updated: src/Entity/Video.php
 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration

===============================================================================
$ bin/console make:entity

 Class name of the entity to create or update (e.g. AgreeableElephant):
 > Video

 created: src/Entity/Video.php
 created: src/Repository/VideoRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > title

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Video.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > user

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > User

What type of relationship is this?
 ------------ ----------------------------------------------------------------- 
  Type         Description                                                      
 ------------ ----------------------------------------------------------------- 
  ManyToOne    Each Video relates to (has) one User.                            
               Each User can relate to (can have) many Video objects            
                                                                                
  OneToMany    Each Video can relate to (can have) many User objects.           
               Each User relates to (has) one Video                             
                                                                                
  ManyToMany   Each Video can relate to (can have) many User objects.           
               Each User can also relate to (can also have) many Video objects  
                                                                                
  OneToOne     Each Video relates to (has) exactly one User.                    
               Each User also relates to (has) exactly one Video.               
 ------------ ----------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Video.user property allowed to be null (nullable)? (yes/no) [yes]:
 > 

 Do you want to add a new property to User so that you can access/update Video objects from it - e.g. $user->getVideos()? (yes/no) [yes]:
 > 

 A new property will also be added to the User class so that you can access the related Video objects from it.

 New field name inside User [videos]:
 > 

 updated: src/Entity/Video.php
 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
 
 ========================================================================================
 $ bin/console make:migration
 $ bin/console doctrine:migrations:migrate
```