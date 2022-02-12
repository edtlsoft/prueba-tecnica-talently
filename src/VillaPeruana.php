<?php

namespace App;

use App\Interfaces\TypeProductInterface;
use App\TipoProducto;

class VillaPeruana
{
    public $quality;

    public $sellIn;

    private $tipoProducto;

    public function __construct(TypeProductInterface $typeProduct, $quality, $sellIn)
    {
        $this->quality = $quality;
        $this->sellIn = $sellIn;
        $this->tipoProducto = $typeProduct;
    }

    public static function of($name, $quality, $sellIn) {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        $this->quality = $this->tipoProducto->calculateNewQuality($this->quality, $this->sellIn);
        $this->sellIn  = $this->tipoProducto->calculateNewSellIn($this->sellIn, 1);
    }
}
