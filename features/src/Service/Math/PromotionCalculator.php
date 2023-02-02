<?php
namespace App\Service\Math;

class PromotionCalculator
{

    /**
     * @param ...$prices
     * @return int
    */
    public function calculatePriceAfterPromotion(...$prices): int
    {
          $start = 0;

          foreach ($prices as $price) {
              $start += $price;
          }

          return $start - ($start * $this->getPromotionPercentage() / 100);
    }


    /**
     * @return int
    */
    public function getPromotionPercentage(): int
    {
         return (int) \file_get_contents(__DIR__.'/file.txt');
    }
}