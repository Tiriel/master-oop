<?php

namespace App\Provider;

use App\Consumer\OMDbApiConsumer;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Transformer\MovieTransformer;

class MovieProvider
{
    public function __construct(
        private MovieRepository $repository,
        private OMDbApiConsumer $consumer,
        private MovieTransformer $transformer
    ) {}

    private function getOneMovie(string $type, string $value): Movie
    {
        $movie = $this->repository->findOneBy([$type => $value]) ?? $this->transformer->arrayToMovie(
                $this->consumer->consume($type, $value)
            );
        if (!$movie->getId()) {
            $this->repository->add($movie, true);
        }

        return $movie;
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
