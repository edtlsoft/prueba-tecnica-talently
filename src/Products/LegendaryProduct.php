<?php

namespace App\Products;

use App\Interfaces\LegendaryProductInterface;

abstract class LegendaryProduct implements LegendaryProductInterface {
    private $quality = 80;

    public function getQualityOfTheLegendaryProduct(): int
    {
        return $this->quality;
    }
} 
