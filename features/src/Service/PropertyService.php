<?php
namespace App\Service;

class PropertyService
{

     public $dummy;


     public $logger;


     public function __construct()
     {
          // There properties defined in services.yaml are not accessible by constructor;
          // You needs to define some action to use them like someAction();
          dump($this->dummy, $this->logger);
     }



     public function someAction()
     {
         dump($this->dummy, $this->logger);
     }
}