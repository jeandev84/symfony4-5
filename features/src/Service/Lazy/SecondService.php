<?php

namespace App\Service\Lazy;

class SecondService
{

     public function __construct()
     {
          dump('from second service');
     }



     public function someMethod(): string
     {
          return "Hello!";
     }
}