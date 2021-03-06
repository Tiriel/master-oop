<?php

namespace App\Transformer;

use App\Entity\ModelIdInterface;
use App\Entity\Movie;
use App\Model as Model;
use App\Model\EntityModelInterface;
use App\Model\Genre;

class MovieModelTransformer implements TransformerInterface
{
    public function __construct(
        private GenreModelTransformer $transformer
    ){}

    public function arrayToModel(array $data): Model\Movie
    {
        $released = $data['Released'] !== 'N/A' ? $data['Released'] : $data['Year'];
        return new Model\Movie(
            $data['Title'],
            new Model\Poster($data['Poster']),
            new Model\CountryCollection($data['Country']),
            new \DateTimeImmutable($released),
            5.0,
            new Model\GenreCollection($data['Genre']),
            new Model\OmdbId($data['imdbID']),
            new Model\MPAARating($data['Rated'])
        );
    }

    public function toEntity(EntityModelInterface $model): Movie
    {
        /** @var Model\Movie $model */
        $movie = (new Movie())
            ->setTitle($model->getTitle())
            ->setPoster($model->getPoster()->getUrl())
            ->setCountry($model->getCountry())
            ->setReleasedAt($model->getReleasedAt())
            ->setPrice($model->getPrice())
            ->setOmdbId($model->getOmdbId()->getOmdbId())
            ->setRated($model->getRated()->getRated())
        ;
        foreach ($model->getGenres() as $genre) {
            /** @var Genre $genre */
            $movie->addGenre($this->transformer->toEntity($genre));
        }

        return $movie;
    }

    public function fromEntity(ModelIdInterface $entity): Model\Movie
    {
        /** @var Movie $entity */
        return new Model\Movie(
            $entity->getTitle(),
            new Model\Poster($entity->getPoster()),
            new Model\CountryCollection($entity->getCountry()),
            $entity->getReleasedAt(),
            $entity->getPrice(),
            new Model\GenreCollection($entity->getGenres()),
            new Model\OmdbId($entity->getOmdbId()),
            new Model\MPAARating($entity->getRated())
        );
    }
}