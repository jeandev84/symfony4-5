<?php

namespace App\Service\Lazy;

class FirstService
{

      public $secondService;


      public function __construct($service)
      {
           dump($service);
           $this->secondService = $service;
      }
}