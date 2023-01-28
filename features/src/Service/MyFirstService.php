<?php
namespace App\Service;

class MyFirstService
{


    /**
     * @var MySecondService
    */
    protected $secondService;

    public function __construct(MySecondService $secondService)
    {
         $this->secondService = $secondService;
    }

}