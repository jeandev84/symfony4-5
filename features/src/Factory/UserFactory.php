<?php
namespace App\Factory;

use App\Entity\User;

class UserFactory
{

    public function createUser(): User
    {
         return new User();
    }


    public function createAdmin()
    {
        // todo implements
    }



    public function createEmployee()
    {
        // todo implements
    }



    public function createManager()
    {
        // todo implements
    }
}