<?php
namespace App\DTO\User;

use Symfony\Component\HttpFoundation\Request;

class SaveUserDto
{
     protected $id;

     protected $name;


    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }



    /**
     * @return int|null
    */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @param string $name
    */
    public function setName(string $name): void
    {
        $this->name = $name;
    }



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }



    public function fromRequest(Request $request): SaveUserDto
    {
         $this->setId($request->request->getInt('id'));
         $this->setName($request->request->get('name'));

         return $this;
    }
}