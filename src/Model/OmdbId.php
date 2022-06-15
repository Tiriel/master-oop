<?php

namespace App\Model;

class OmdbId
{
    public function __construct(
        private string $omdbId
    ){}

    public function getOmdbId(): string
    {
        return $this->omdbId;
    }
}