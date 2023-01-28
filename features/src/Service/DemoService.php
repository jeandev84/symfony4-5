<?php
namespace App\Service;

class DemoService
{


     /**
      * @var string
     */
     protected $globalParam;



     /**
      * @var string
     */
     protected $param1;


     /**
      * @var string
     */
     protected $param2;


     /**
      * @var string
     */
     protected $adminEmail;


     /**
      * @param string $globalParam
      * @param string $param1
      * @param string $param2
      * @param string $adminEmail
     */
     public function __construct(string $globalParam, string $param1, string $param2, string $adminEmail)
     {
          // dump('I am live');
          $this->globalParam = $globalParam;
          $this->param1 = $param1;
          $this->param2 = $param2;
          $this->adminEmail = $adminEmail;
     }




     /**
      * @return string
     */
     public function getParam1(): string
     {
         return $this->param1;
     }


     /**
      * @return string
     */
     public function getParam2(): string
     {
         return $this->param2;
     }


    /**
     * @return string
     */
    public function getAdminEmail(): string
    {
        return $this->admin_email;
    }
}