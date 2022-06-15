<?php

namespace App\Model;

class MPAARating
{
    public const G = 'G';
    public const PG = 'PG';
    public const PG_13 = 'PG-13';
    public const NC_17 = 'NC-17';
    public const R = 'R';
    public const RATINGS = [
        self::G,
        self::PG,
        self::PG_13,
        self::NC_17,
        self::R,
    ];

    public function __construct(
        private string $rated
    ){
        if (!in_array($this->rated, self::RATINGS)) {
            throw new \RuntimeException(sprintf("Unknown rating given: %s", $this->rated));
        }
    }

    public function getRated(): string
    {
        return $this->rated;
    }
}