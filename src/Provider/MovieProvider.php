<?php

namespace App\Provider;

use App\Consumer\OMDbApiConsumer;
use App\Entity\Movie;
use App\Transformer\MovieTransformer;
use Symfony\Component\HttpClient\HttpClient;

class MovieProvider
{
    private OMDbApiConsumer $consumer;
    private MovieTransformer $transformer;

    public function __construct() {
        $this->consumer = new OMDbApiConsumer();
        $this->transformer = new MovieTransformer();
    }

    public function getOneMovie(string $type, string $value): Movie
    {
        return $this->transformer->arrayToMovie(
            $this->consumer->consume($type, $value)
        );
    }

    public function getById(string $id): Movie
    {
        return $this->getOneMovie(OMDbApiConsumer::MODE_ID, $id);
    }

    public function getByTitle(string $title): Movie
    {
        return $this->getOneMovie(OMDbApiConsumer::MODE_TITLE, $title);
    }
}