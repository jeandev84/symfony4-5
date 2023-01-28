<?php
namespace App\Service;

class MyFirstService
{

     use OptionalServiceTrait;


     protected $service;

     public function __construct()
     {

     }


//    /**
//     * @required
//     * @param MyThirdService $thirdService
//     * @return void
//    */
//    public function setMyThirdService(MyThirdService $thirdService)
//    {
//         dump('@required annotation inject "thirdService" automatically to the constructor');
//         dd($thirdService);
//    }



     public function someAction()
     {
          return $this->service->doSomething2();
     }

}