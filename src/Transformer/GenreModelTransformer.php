<?php

namespace App\Transformer;

use App\Entity\Genre as GenreEntity;
use App\Entity\ModelIdInterface;
use App\Model\EntityModelInterface;
use App\Model\Genre;
use App\Model\Poster;

class GenreModelTransformer implements TransformerInterface
{

    public function toEntity(EntityModelInterface $model): GenreEntity
    {
        return (new GenreEntity())
            ->setName($model->getName())
            ->setPoster($model->getPoster());
    }

    public function fromEntity(ModelIdInterface $entity): Genre
    {
        return new Genre(
            $entity->getName(),
            new Poster($entity->getPoster())
        );
    }
}