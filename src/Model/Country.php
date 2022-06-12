<?php

namespace App\Model;

use Symfony\Component\Intl\Countries;

class Country
{
    public function __construct(
        private string $country
    ){
        if (!in_array($this->country, Countries::getNames())) {
            throw new \RuntimeException(sprintf("Unknown country name: %s", $this->country));
        }
    }

    public function __invoke()
    {
        return $this->country;
    }
}