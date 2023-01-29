<?php
namespace App\Service\Module;

class PushContentToArrayService
{

     protected $data;

     public function __construct(array $data)
     {
          $this->data = $data;
     }

     public function addContent(string $content)
     {
         array_push($this->data, $content);

         return $this;
     }


     public function getData()
     {
         return $this->data;
     }
}