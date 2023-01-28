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
     protected $admin_email;


     /**
      * @param string $globalParam
      * @param string $param1
      * @param string $param2
      * @param string $admin_email
     */
     public function __construct(string $globalParam, string $param1, string $param2, string $admin_email)
     {
          // dump('I am live');
          $this->globalParam = $globalParam;
          $this->param1 = $param1;
          $this->param2 = $param2;
          $this->admin_email = $admin_email;
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