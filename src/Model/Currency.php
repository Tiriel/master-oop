<?php

namespace App\Model;

class Currency
{
    public function __construct(
        private string $currency
    ){}

    public function getCurrency(): string
    {
        return $this->currency;
    }
}