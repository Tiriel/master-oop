<?php

namespace App\Transformer;

use App\Entity\Genre as GenreEntity;
use App\Entity\ModelIdInterface;
use App\Model\EntityModelInterface;
use App\Model\Genre;

class GenreModelTransformer implements TransformerInterface
{

    public function toEntity(EntityModelInterface $model): GenreEntity
    {
        // TODO: Implement toEntity() method.
    }

    public function fromEntity(ModelIdInterface $entity): Genre
    {
        // TODO: Implement fromEntity() method.
    }
}