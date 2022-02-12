<?php

namespace App\Interfaces;

interface TypeProductInterface {
    public function calculateNewSellIn($sellIn, $daysToDecrease): int;
    
    public function calculateNewQuality($quality, $sellIn): int;
}
