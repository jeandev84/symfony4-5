<?php
namespace App\Service;

trait OptionalServiceTrait
{

    protected $service;


    /**
     * @required
     * @param MySecondService $mySecondService
     * @return void
    */
    public function setMySecondService(MySecondService $mySecondService)
    {
        $this->service = $mySecondService;
    }
}