<?php

namespace App\Model;

use App\Entity\ModelIdInterface;
use App\Entity\Movie as MovieEntity;

class Movie implements EntityModelInterface
{
    public function __construct(
        private Id $id,
        private string $title,
        private Poster $poster,
        private CountryCollection $country,
        private \DateTimeImmutable $releasedAt,
        private float $price,
        private GenreCollection $genres,
        private OmdbId $omdbId,
        private MPAARating $rated
    ){}

    public function getId(): Id
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPoster(): Poster
    {
        return $this->poster;
    }

    public function getCountry(): CountryCollection
    {
        return $this->country;
    }

    public function getReleasedAt(): \DateTimeImmutable
    {
        return $this->releasedAt;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getGenres(): GenreCollection
    {
        return $this->genres;
    }

    public function getOmdbId(): OmdbId
    {
        return $this->omdbId;
    }

    public function getRated(): MPAARating
    {
        return $this->rated;
    }
}