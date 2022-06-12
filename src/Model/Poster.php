<?php

namespace App\Model;

class Poster
{
    public function __construct(
        private string $url
    ){}

    public function __invoke()
    {
        return $this->url;
    }
}