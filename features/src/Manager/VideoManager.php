<?php
namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

class VideoManager
{

    /**
     * @var EntityManagerInterface
    */
    protected $entityManager;


    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->entityManager = $entityManager;
    }

}