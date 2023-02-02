<?php
namespace App\Service\Math;

class Calculator
{

    /**
     * @param int $a
     * @param int $b
     * @return int
    */
    public function add(int $a, int $b): int
    {
         return $a + $b;
    }
}