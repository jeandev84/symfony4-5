### Send Email (Events & Listeners)

1. Introduction EventListener
```php 
<?php
namespace App\Listeners;

/* use Doctrine\Common\Persistence\Event\LifecycleEventArgs; */

use App\Entity\Video;
use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;


/**
 *
*/
class NewVideoListener
{

    public function postPersist(LifecycleEventArgs $args)
    {

        $entity = $args->getObject();

        // only act on some "Video" entity
        if (!$entity instanceof Video) {
            return;
        }

        $entityManager = $args->getObjectManager();
        // ... do something with the Product

        $users = $entityManager->getRepository(User::class)->findAll();

        foreach ($users as $user) {
             exit($user->getName() . ' '. $entity->getTitle());
        }
    }
}
```


2. Load package SwiftMailer 
```php 
$ composer require symfony/swiftmailer-bundle

Stimulate sending email in mode "prod"
$ bin/console swiftmailer:spool:send --message-limit=10 --env=prod
```

