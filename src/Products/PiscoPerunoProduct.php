<?php

namespace App\Products;

use App\Interfaces\TypeProductInterface;
use App\Traits\QualityLimitsTrait;

class PiscoPerunoProduct implements TypeProductInterface {
    use QualityLimitsTrait;

    public function calculateNewSellIn($sellIn, $daysToDecrease): int {
        return $sellIn - $daysToDecrease;
    }

    public function calculateNewQuality($quality, $sellIn): int {
        $newQuality = $quality + $this->calculateQuantityQualityToDecrease($quality, $sellIn);

        return $this->validateQualityLimits($newQuality);
    }

    private function calculateQuantityQualityToDecrease($quality, $sellIn): int {
        $quantiyQualityToDecrease = 1;

        if ($sellIn > 0 && $sellIn <= 5) {
            $quantiyQualityToDecrease = 3;
        }
        else if ($sellIn > 5 && $sellIn <= 10) {
            $quantiyQualityToDecrease = 2;
        }
        else if ($sellIn === 0 ) {
            $quantiyQualityToDecrease = -$quality;
        }

        return $quantiyQualityToDecrease;
    }
}
