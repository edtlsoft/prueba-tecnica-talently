<?php

namespace App\Products;

use App\Interfaces\TypeProductInterface;

class TumiProduct extends LegendaryProduct implements TypeProductInterface {
    public function calculateNewSellIn($sellIn, $daysToDecrease): int {
        return $sellIn;
    }

    public function calculateNewQuality($quality, $sellIn): int {
        return $this->getQualityOfTheLegendaryProduct();
    }
}
