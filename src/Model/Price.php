<?php

namespace App\Model;

class Price
{
    public function __construct(
        private float $price
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }
}