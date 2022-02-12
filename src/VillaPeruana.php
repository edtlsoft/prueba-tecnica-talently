<?php

namespace App;

class VillaPeruana
{
    public $name;

    public $quality;

    public $sellIn;
    
    private $ticketNameVIP = 'Ticket VIP al concierto de Pick Floid';
    
    private $tumiName = 'Tumi de Oro Moche';
    
    private $piscoPeruano = 'Pisco Peruano'; 

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of($name, $quality, $sellIn) {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        if ($this->sellIn > 0) {
            $this->updateQuality(-1);
        }
        else {
            $this->updateQuality(-2);
        }

        $this->updateSellIn(1);
    }

    private function updateSellIn($quantity) {
        $this->sellIn -= $this->name === $this->tumiName ? 0 : $quantity;
    }

    private function updateQuality($quantity) {
        $quantity   = $this->calculateQuantityQualityForTypeOfProduct($quantity);
        $newQuality = $this->quality + $quantity;

        if ($newQuality > 50 && $this->name != $this->tumiName) {
            $newQuality = 50;
        }
        else if ($newQuality < 0) {
            $newQuality = 0;
        }
        
        $this->quality = $newQuality;
    }

    private function calculateQuantityQualityForTypeOfProduct($quantity)
    {
        if ($this->name === $this->piscoPeruano) {
            $quantity = $this->calculateQuantityQualityForPiscoPeruano();
        }
        else if ($this->name === $this->tumiName) {
            $quantity = $this->calculateQuantityQualityForTumi();
        }
        else if ($this->name === $this->ticketNameVIP) {
            $quantity = $this->calculateQuantityQualityForTicketVIP();
        }

        return $quantity;
    }

    private function calculateQuantityQualityForPiscoPeruano() {
        return $this->calculateQuantityQualityForPiscoPeruanoOrTicketVIP();
    }

    private function calculateQuantityQualityForTumi() {
        $this->quality = 80;
        return 0;
    }

    private function calculateQuantityQualityForTicketVIP() {
        return $this->sellIn < 0 ? -$this->quality : $this->calculateQuantityQualityForPiscoPeruanoOrTicketVIP();
    }

    private function calculateQuantityQualityForPiscoPeruanoOrTicketVIP() {
        $quantity = 1;

        if ($this->sellIn > 0 && $this->sellIn <= 5) {
            $quantity = 3;
        }
        else if ($this->sellIn > 5 && $this->sellIn <= 10) {
            $quantity = 2;
        }
        else if ($this->sellIn === 0 ) {
            $quantity = -$this->quality;
        }

        return $quantity;
    }
}
