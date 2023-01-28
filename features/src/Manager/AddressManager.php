<?php
namespace App\Manager;

use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;

class AddressManager
{

    /**
     * @var EntityManagerInterface
    */
    protected $entityManager;


    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @param Address $address
     * @return Address
    */
    public function saveAddress(Address $address): Address
    {
         $this->entityManager->persist($address);
         $this->entityManager->flush();

         return $address;
    }


    /**
     * @param array $payload
     * @return Address
    */
    public function createAddress(array $payload): Address
    {
         $address = new Address();
         $address->setStreet($payload['address']);
         $address->setNumber($payload['number']);

         return $this->saveAddress($address);
    }

}