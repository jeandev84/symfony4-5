### Caching 

```php 
$ composer require symfony/cache

$ bin/console make:subscriber 

Choose a class name for your event subscriber (e.g. ExceptionSubscriber):
> AdminChangesDataSubscriber

Suggested Events:
* Symfony\Component\Mailer\Event\MessageEvent (Symfony\Component\Mailer\Event\MessageEvent)
* console.command (Symfony\Component\Console\Event\ConsoleCommandEvent)
* console.error (Symfony\Component\Console\Event\ConsoleErrorEvent)
* console.terminate (Symfony\Component\Console\Event\ConsoleTerminateEvent)
* debug.security.authorization.vote (Symfony\Component\Security\Core\Event\VoteEvent)
* kernel.controller (Symfony\Component\HttpKernel\Event\ControllerEvent)
* kernel.controller_arguments (Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent)
* kernel.exception (Symfony\Component\HttpKernel\Event\ExceptionEvent)
* kernel.finish_request (Symfony\Component\HttpKernel\Event\FinishRequestEvent)
* kernel.request (Symfony\Component\HttpKernel\Event\RequestEvent)
* kernel.response (Symfony\Component\HttpKernel\Event\ResponseEvent)
* kernel.terminate (Symfony\Component\HttpKernel\Event\TerminateEvent)
* kernel.view (Symfony\Component\HttpKernel\Event\ViewEvent)
* knp_pager.before (Knp\Component\Pager\Event\BeforeEvent)
* knp_pager.pagination (Knp\Component\Pager\Event\PaginationEvent)
* security.authentication.failure (Symfony\Component\Security\Core\Event\AuthenticationFailureEvent)
* security.authentication.success (Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent)
* security.interactive_login (Symfony\Component\Security\Http\Event\InteractiveLoginEvent)
* security.switch_user (Symfony\Component\Security\Http\Event\SwitchUserEvent)

What event do you want to subscribe to?:
> kernel.response

created: src/EventSubscriber/AdminChangesDataSubscriber.php

       
Success! 
       

Next: Open your new subscriber class and start customizing it.
Find the documentation at https://symfony.com/doc/current/event_dispatcher.html#creating-an-event-subscriber
 
```