<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\Math\PromotionCalculator;


class PromotionCalculatorTest extends TestCase
{
    public function testSomething(): void
    {
         $calculator = $this->getMockBuilder(PromotionCalculator::class)
                            ->setMethods(['getPromotionPercentage'])
                            ->getMock();


         $calculator->expects($this->any())
                    ->method('getPromotionPercentage')
                    ->willReturn(20);


         // 10 - 20% * 10{2} = 8
         $result = $calculator->calculatePriceAfterPromotion(1, 9);

         $this->assertEquals(8, $result);

         // 80 - 20%80{16}  = 64
         $result = $calculator->calculatePriceAfterPromotion(10, 20, 50);

         $this->assertEquals(64, $result);
    }
}
