<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use function PHPUnit\Framework\exactly;

class CountryCollection extends ArrayCollection
{
    public function __construct(string $countryString)
    {
        $elements = [];
        $countries = explode(', ', $countryString);
        foreach ($countries as $string) {
            $elements[] = new Country($string);
        }

        parent::__construct($elements);
    }

    public function __toString()
    {
        return implode(', ', $this->map(function (Country $country) {
            return $country->getCountry();
        }));
    }
}