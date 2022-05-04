<?php

namespace App\Provider;

use App\Consumer\OMDbApiConsumer;
use App\Entity\Movie;
use App\Transformer\MovieTransformer;

class MovieProvider
{
    public function __construct(
        private OMDbApiConsumer $consumer,
        private MovieTransformer $transformer
    ) {}

    public function getByTitle(string $title): Movie
    {
        return $this->transformer->arrayToMovie(
            $this->consumer->consume(OMDbApiConsumer::MODE_TITLE, $title)
        );
    }
}