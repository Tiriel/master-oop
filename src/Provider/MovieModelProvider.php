<?php

namespace App\Provider;

use App\Consumer\OMDbApiConsumer;
use App\Model\Movie;
use App\Repository\MovieRepository;
use App\Transformer\MovieModelTransformer;

class MovieModelProvider
{
    public function __construct(
        private OMDbApiConsumer $consumer,
        private MovieRepository $repository,
        private MovieModelTransformer $transformer
    ){}

    public function getMovieByTitle(string $title): Movie
    {
        return $this->getOneMovie(OMDbApiConsumer::MODE_TITLE, $title);
    }

    public function getMovieById(string $id): Movie
    {
        return $this->getOneMovie(OMDbApiConsumer::MODE_ID, $id);
    }

    private function getOneMovie(string $type, string $value): Movie
    {
        $property = OMDbApiConsumer::MODE_ID === $type ? 'id' : 'title';
        if (null !== $movie = $this->repository->findOneBy([$property => $value])) {
            return $this->transformer->entityToModelMovie($movie);
        }

        $movie = $this->transformer->arrayToModelMovie(
            $this->consumer->consume($type, $value)
        );
        $this->repository->add($movie->toEntity());

        return $movie;
    }
}