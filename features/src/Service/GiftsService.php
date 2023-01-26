<?php
namespace App\Service;



class GiftsService
{

    /**
     * Cadeaux [ подарки ]
     *
     * @var string[]
    */
    private $gifts = ['flowers', 'car', 'piano', 'money'];



    public function __construct(array $gifts = [])
    {
        if ($gifts) {
            $this->setGifts($gifts);
        }
    }

    public function setGifts(array $gifts)
    {
        $this->gifts = $gifts;
    }



    public function randomizedGifts(): array
    {
         shuffle($this->gifts);

         return $this->gifts;
    }

}