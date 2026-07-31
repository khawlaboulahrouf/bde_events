<?php

namespace App;

use Ramsey\Uuid\Type\Decimal;

class BestEvent
{

    /**
     * Create a new class instance.
     */
    public function __construct(private string $titre,
        private Decimal $prix,
        private int $capacite)
    {
        //

    }
    public function estPlusAvantageuxQue(Evenement $autre): bool{
        $prix = 10;
        $capacite =50;

        if($prix < $autre || $capacite >$autre){
            return true;

        }
    }
}
