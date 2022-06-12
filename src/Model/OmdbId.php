<?php

namespace App\Model;

class OmdbId
{
    public function __construct(
        private string $omdbId
    ){}

    public function __invoke()
    {
        return $this->omdbId;
    }
}