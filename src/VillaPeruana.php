<?php

namespace App;

use App\TipoProducto;

class VillaPeruana
{
    public $name;

    public $quality;

    public $sellIn;

    private $tipoProducto;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
        $this->tipoProducto = new TipoProducto($this->name);
    }

    public static function of($name, $quality, $sellIn) {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        $quantiyQualityToDecrease = $this->sellIn > 0 ? -1 : -2;
        $this->quality = $this->tipoProducto->calculateNewQuality($this->quality, $quantiyQualityToDecrease, $this->sellIn);
        $this->sellIn  = $this->tipoProducto->calculateNewSellIn($this->sellIn, 1);
    }
}
