<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\Math\CalculatorService;


class CalculatorTest extends TestCase
{
    public function testSomething(): void
    {
        $calculator = new CalculatorService();
        $result     = $calculator->add(1, 9);

        $this->assertEquals(10, $result);
    }
}
