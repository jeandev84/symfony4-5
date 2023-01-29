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

============= DEBUG BUNDLE ============================================================
$ composer require symfony/web-profiler-bundle || composer require web-profiler-bundle
$ composer require symfony/debug-bundle
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
$ bin/console doctrine:migrations:migrate -n -q
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
  bin/console make:migration &
  bin/console doctrine:migrations:migrate -n -q &
  bin/console doctrine:fixtures:load
```


8. Framework Extra Bundle 
```
$ composer require sensio/framework-extra-bundle
```


9. Doctrine Relationships
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
 
 =======================================================================================
 REBOOT DATABASE:
 
$ bin/console doctrine:schema:drop -n -q --force --full-database && rm ./migrations/*.php && bin/console make:migration && bin/console doctrine:migrations:migrate -n -q


=======================================================================================
FIXTURE LOAD ALL || FIXTURE ONE BY ONE

$ bin/console doctrine:fixtures:load
$ bin/console doctrine:fixtures:load --group=VideoFixtures
$ bin/console doctrine:fixtures:load --group=UserFixtures

======================================================================================
$ bin/console doctrine:database:create
$ bin/console doctrine:schema:drop -n -q --force --full-database && rm ./migrations/*.php && bin/console make:migration && bin/console doctrine:migrations:migrate -n -q
```



10. Doctrine Inheritance mapping  
```
Author Entity                       ==> (OneToMany) File Entity (Abstract class: filename, size, description)
Video  Entity (format description)  => Pdf Entity (pages_number, orientation) extends from Abstract class (File Entity)


=========================== MAKE ENTITY ==============================================

@terminal$ bin/console make:entity

 Class name of the entity to create or update (e.g. GentleChef):
 > Author

 created: src/Entity/Author.php
 created: src/Repository/AuthorRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > name

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Author.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
 
@terminal$ clear
@terminal$ bin/console make:entity

 Class name of the entity to create or update (e.g. BravePopsicle):
 > File

 created: src/Entity/File.php
 created: src/Repository/FileRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > filename

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/File.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > size

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > ^C
@terminal$ clear
@terminal$ bin/console make:entity File

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > size

 Field type (enter ? to see all types) [string]:
 > integer

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/File.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > description

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/File.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
 
@terminal$ bin/console make:entity

 Class name of the entity to create or update (e.g. GentleChef):
 > Video

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > format

 Field type (enter ? to see all types) [string]:
 > 
@terminal$ clear
@terminal$ bin/console make:entity

 Class name of the entity to create or update (e.g. TinyPopsicle):
 > VideoFile

 created: src/Entity/VideoFile.php
 created: src/Repository/VideoFileRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > format

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/VideoFile.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > duration

 Field type (enter ? to see all types) [string]:
 > integer

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/VideoFile.php


 
@terminal$ clear
@terminal$ bin/console make:entity

 Class name of the entity to create or update (e.g. GentlePopsicle):
 > PdfFile

 created: src/Entity/PdfFile.php
 created: src/Repository/PdfFileRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > pages_number

 Field type (enter ? to see all types) [string]:
 > integer

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/PdfFile.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > orientation

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/PdfFile.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
 
@terminal$ clear
@terminal$ bin/console make:entity

 Class name of the entity to create or update (e.g. TinyPuppy):
 > Inheritance\Author

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > files

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Inheritance\File

What type of relationship is this?
 ------------ ------------------------------------------------------------------ 
  Type         Description                                                       
 ------------ ------------------------------------------------------------------ 
  ManyToOne    Each Author relates to (has) one File.                            
               Each File can relate to (can have) many Author objects            
                                                                                 
  OneToMany    Each Author can relate to (can have) many File objects.           
               Each File relates to (has) one Author                             
                                                                                 
  ManyToMany   Each Author can relate to (can have) many File objects.           
               Each File can also relate to (can also have) many Author objects  
                                                                                 
  OneToOne     Each Author relates to (has) exactly one File.                    
               Each File also relates to (has) exactly one Author.               
 ------------ ------------------------------------------------------------------ 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > OneToMany

 A new property will also be added to the File class so that you can access and set the related Author object from it.

 New field name inside File [author]:
 > 

 Is the File.author property allowed to be null (nullable)? (yes/no) [yes]:
 > 

 updated: src/Entity/Inheritance/Author.php
 updated: src/Entity/Inheritance/File.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
 
@terminal$ 


=========================== ENTITIES  ===============================

<?php
namespace App\Entity\Inheritance;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Inheritance\AuthorRepository;


/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
*/
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="author")
     */
    private $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setAuthor($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getAuthor() === $this) {
                $file->setAuthor(null);
            }
        }

        return $this;
    }
}



<?php
namespace App\Entity\Inheritance\Files;

use App\Entity\Inheritance\File;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Inheritance\Files\PdfFileRepository;



/**
 * @ORM\Entity(repositoryClass=PdfFileRepository::class)
 */
class PdfFile extends File
{

    /**
     * @ORM\Column(type="integer")
    */
    private $pages_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orientation;


    public function getPagesNumber(): ?int
    {
        return $this->pages_number;
    }

    public function setPagesNumber(int $pages_number): self
    {
        $this->pages_number = $pages_number;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }
}



<?php
namespace App\Entity\Inheritance\Files;


use App\Entity\Inheritance\File;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Inheritance\Files\VideoFileRepository;



/**
 * @ORM\Entity(repositoryClass=VideoFileRepository::class)
*/
class VideoFile extends File
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;


    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}


================== INHERITANCE TABLE TYPE ( SINGLE_TABLE )==================================================

<?php
namespace App\Entity\Inheritance;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\Inheritance\FileRepository;



/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="typeOfFile", type="string")
 * @ORM\DiscriminatorMap({
 *     "video" = "App\Entity\Inheritance\Files\VideoFile",
 *     "pdf" = "App\Entity\Inheritance\Files\PdfFile"
 * })
*/
abstract class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="files")
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}


@terminal $ bin/console doctrine:schema:drop -n -q --force --full-database && rm ./migrations/*.php && bin/console make:migration && bin/console doctrine:migrations:migrate -n -q

           
Success! 
           

Next: Review the new migration "migrations/Version20230128192358.php"
Then: Run the migration with php bin/console doctrine:migrations:migrate

@terminal$ 


============================= INHERITANCE MAPPING (JOINED) ========================================

<?php
namespace App\Entity\Inheritance;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\Inheritance\FileRepository;



/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="typeOfFile", type="string")
 * @ORM\DiscriminatorMap({
 *     "video" = "App\Entity\Inheritance\Files\VideoFile",
 *     "pdf" = "App\Entity\Inheritance\Files\PdfFile"
 * })
*/
abstract class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="files")
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}

```


11. Services 
```
$ composer require symfony/proxy-manager-bridge
$ bin/console debug:autowiring [ DEBUG ALL types hinting of services ]
$ bin/console debug:container  [ DEBUG ALL SERVICE IN CONTAINER ]
```

12. Symfony Cache Component
```
$ composer require symfony/cache
```

13. Symfony console commands 
```
$ bin/console about
$ bin/console list
$ bin/console list doctrine
$ bin/console debug:router
$ bin/console debug:autowiring
$ bin/console debug:container
$ bin/console debug:config services (service.yaml)
$ bin/console debug:config twig (twig.yaml)
$ bin/console make:controller
$ bin/console help make:controller
$ bin/console make:entity
```


14. Deploy Symfony application 
```
# https://symfony.com/doc/current/deployment.html
$ composer require symfony/requirements-checker

http://localhost:8000/check.php

$ composer remove symfony/requirements-checker
$ composer install --no-dev --optimize-autoloader
$ composer dump-autoload --optimize --no-dev --classmap-authoritative
$ bin/console doctrine:database:create
$ bin/console doctrine:migrations:generate
$ bin/console cache:clear --env=prod --no-debug
```


15. Events 
```
$ bin/console debug:event-dispatcher
```

16. Create a EventListener 
```

```