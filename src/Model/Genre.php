<?php

namespace App\Model;

use App\Entity\Genre as GenreEntity;
use App\Entity\ModelIdInterface;

class Genre implements EntityModelInterface
{
    public function __construct(
        private Id $id,
        private string $name,
        private Poster|null $poster = null,
    ){}

    public function toEntity(): ModelIdInterface
    {
        return (new GenreEntity())
            ->setId(($this->id)())
            ->setName($this->name)
            ->setPoster(($this->poster)());
    }

    public static function fromEntity(ModelIdInterface $entity): static
    {
        /** @var GenreEntity $entity */
        return new static(
            new Id($entity->getId()),
            $entity->getName(),
            new Poster($entity->getPoster())
        );
    }
}