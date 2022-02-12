<?php

namespace App\Traits;

Trait QualityLimitsTrait {
    protected function validateQualityLimits($quality) {
        if ($quality > 50) {
            $quality = 50;
        }
        else if ($quality < 0) {
            $quality = 0;
        }

        return $quality;
    }
}