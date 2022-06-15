<?php

namespace App\Provider;

use App\Consumer\OMDbApiConsumer;
use App\Model\Movie;
use App\Repository\MovieRepository;
use App\Transformer\MovieModelTransformer;

class MovieModelProvider
{
    public function __construct(
        private MovieRepository $repository,
        private OMDbApiConsumer $consumer,
        private MovieModelTransformer $transformer
    ) {}

    public function getById(string $id): Movie
    {
        return $this->getOneMovie(OMDbApiConsumer::MODE_ID, $id);
    }

    public function getByTitle(string $title): Movie
    {
        return $this->getOneMovie(OMDbApiConsumer::MODE_TITLE, $title);
    }

    private function getOneMovie(string $type, string $value): Movie
    {
        if ($movieEntity = $this->repository->findOneBy([$type => $value])) {
            return $this->transformer->fromEntity($movieEntity);
        }

        return $this->getFromApi($type, $value);
    }

    private function getFromApi(string $type, string $value): Movie
    {
        $movie = $this->transformer->arrayToModel(
            $this->consumer->consume($type, $value)
        );
        $this->repository->add($this->transformer->toEntity($movie), true);

        return $movie;
    }
}
