<?php
namespace App\Service;

class MyServiceWithAlias
{

      /**
       * @var array
      */
      protected $definition = [];


      /**
       * @var string
      */
      protected $something;


      /**
       * @param array $definition
       * @param string $something
      */
      public function __construct(array $definition, string $something)
      {
            // dump(__CLASS__);
            dump($this->definition, $something);
      }




      /**
       * @param array $definition
       * @return $this
      */
      public function withDefinition(array $definition): MyServiceWithAlias
      {
            $this->definition = $definition;

            return $this;
      }




      /**
       * @param string $something
       * @return $this
      */
      public function withSomething(string $something): MyServiceWithAlias
      {
           $this->something = $something;

           return $this;
      }
}