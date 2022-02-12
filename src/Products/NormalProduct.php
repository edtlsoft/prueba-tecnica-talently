<?php

namespace App\Products;

use App\Interfaces\TypeProductInterface;
use App\Traits\QualityLimitsTrait;

class NormalProduct implements TypeProductInterface {
    use QualityLimitsTrait;

    public function calculateNewSellIn($sellIn, $daysToDecrease): int {
        return $sellIn - $daysToDecrease;
    }

    public function calculateNewQuality($quality, $sellIn): int {
        $quantiyQualityToDecrease = $sellIn > 0 ? -1 : -2;
        
        $newQuality = $quality + $quantiyQualityToDecrease;
        
        return $this->validateQualityLimits($newQuality);
    }
}
