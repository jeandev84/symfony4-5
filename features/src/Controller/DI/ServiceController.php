<?php
namespace App\Controller\DI;

use App\Entity\User;
use App\Service\DemoService;
use App\Service\Lazy\FirstService;
use App\Service\MyFirstService;
use App\Service\MyServiceWithAlias;
use App\Service\PropertyService;
use App\Service\Upload\Contract\FileUploaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ServiceController  extends AbstractController
{


       protected $container;


       public function __construct(ContainerInterface $container)
       {
            $this->container = $container;
       }


       /**
        * @Route("/demo-service", name="demo.service")
       */
       public function showDemoService(DemoService $demoService)
       {
             dd($demoService);
       }



      /**
       * @Route("/first-service", name="first.service")
      */
       public function showMyFirstService(MyFirstService $firstService)
       {
             // dd($firstService);

             dd($firstService->someAction());
       }




       /**
        * @Route("/property-service", name="property.service")
       */
       public function showPropertyService(PropertyService $propertyService)
       {
             $propertyService->someAction();

             dd('Finish execution!');
       }




      /**
       * @Route("/lazy-service", name="lazy.service")
      */
      public function showLazyService(FirstService $service)
      {
            // dd($firstService);

            dd($service->secondService->someMethod());
      }




      /**
       * @Route("/alias-service", name="alias.service")
      */
      public function showServiceWithAlias(MyServiceWithAlias $myServiceWithAlias)
      {
             dump($myServiceWithAlias);

             dd($this->container);

             // dd($this->container->get('app.service.alias'));
      }




      /**
       * @Route("/tags-service", name="tags.service")
      */
      public function showServiceTags(EntityManagerInterface $entityManager)
      {
            $user = $entityManager->getRepository(User::class)->find(1);
            $user->setName('Rob');

            $entityManager->flush();

            dd($user);
      }




      /**
       * @Route("/file-uploader-service", name="file.uploader.service")
      */
      public function uploadFile(FileUploaderInterface $uploader)
      {
             dd($uploader);
      }
}