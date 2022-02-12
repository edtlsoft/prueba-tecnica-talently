<?php

namespace App;

class TipoProducto
{   
    public $name;

    private $ticketNameVIP = 'Ticket VIP al concierto de Pick Floid';
    
    private $tumiName = 'Tumi de Oro Moche';
    
    private $piscoPeruano = 'Pisco Peruano'; 

    private $coffeeName = 'Café Altocusco';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function calculateNewSellIn($sellIn, $daysToDecrease) {
        return $sellIn - $this->calculateQuantityDaysToDecrease($daysToDecrease);
    }

    public function calculateQuantityDaysToDecrease($daysToDecrease) {
        return $this->name === $this->tumiName ? 0 : $daysToDecrease;
    }

    public function calculateNewQuality($quality, $quantiyQualityToDecrease, $sellIn) {
        if ($this->name === $this->tumiName) {
            return 80;
        }
        
        $newQuality = $quality + $this->calculateQuantityQualityToDecrease($quality, $quantiyQualityToDecrease, $sellIn);

        if ($newQuality > 50 && $this->name != $this->tumiName) {
            $newQuality = 50;
        }
        else if ($newQuality < 0) {
            $newQuality = 0;
        }

        return $newQuality;
    }

    public function calculateQuantityQualityToDecrease($quality, $quantiyQualityToDecrease, $sellIn)
    {
        if ($this->name === $this->piscoPeruano) {
            $quantiyQualityToDecrease = $this->calculateQuantityQualityToDecreaseForPiscoPeruano($sellIn, $quality);
        }
        else if ($this->name === $this->ticketNameVIP) {
            $quantiyQualityToDecrease = $this->calculateQuantityQualityToDecreaseForTicketVIP($sellIn, $quality);
        }
        else if ($this->name === $this->coffeeName) {
            $quantiyQualityToDecrease += $quantiyQualityToDecrease; 
        }

        return $quantiyQualityToDecrease;
    }

    private function calculateQuantityQualityToDecreaseForPiscoPeruano($sellIn, $quality) {
        return $this->calculateQuantityQualityToDecreaseForPiscoPeruanoOrTicketVIP($sellIn, $quality);
    }

    private function calculateQuantityQualityToDecreaseForTicketVIP($sellIn, $quality) {
        return $sellIn < 0 ? -$quality : $this->calculateQuantityQualityToDecreaseForPiscoPeruanoOrTicketVIP($sellIn, $quality);
    }

    private function calculateQuantityQualityToDecreaseForPiscoPeruanoOrTicketVIP($sellIn, $quality) {
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
