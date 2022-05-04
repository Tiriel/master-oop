<?php

namespace App\Transformer;

use App\Entity\Genre;
use App\Entity\Movie;

class MovieTransformer
{
    public function arrayToMovie(array $data): Movie
    {
        $genres = explode(', ', $data['Genre']);
        $movie = (new Movie())
            ->setTitle($data['Title'])
            ->setPoster($data['Poster'])
            ->setCountry($data['Country'])
            ->setReleasedAt(new \DateTimeImmutable($data['Released']))
            ->setOmdbId($data['imdbID'])
            ->setRated($data['Rated'])
            ->setPrice(5.0)
        ;

        foreach ($genres as $genre) {
            $genreEnt = (new Genre())
                ->setName($genre)
                ->setPoster($data['Poster'])
            ;
            $movie->addGenre($genreEnt);
        }

        return $movie;
    }
}