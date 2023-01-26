<?php
namespace App\Service;



use Psr\Log\LoggerInterface;

class GiftsService
{

    /**
     * Cadeaux [ подарки ]
     *
     * @var string[]
    */
    private $gifts = ['flowers', 'car', 'piano', 'money'];



    public function __construct(LoggerInterface $logger)
    {
         $logger->info('Gifts were randomized!');
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