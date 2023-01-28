<?php
namespace App\Service;

class MySecondService
{
     public function __construct()
     {
          dump('from second service');

          // $this->doSomething();
     }



    public function doSomething()
    {
        dump('Doing something');
    }


    public function doSomething2(): string
    {
         return 'wow!';
    }

}