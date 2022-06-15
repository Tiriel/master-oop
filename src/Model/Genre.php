<?php

namespace App\Model;

use App\Entity\Genre as GenreEntity;
use App\Entity\ModelIdInterface;

class Genre implements EntityModelInterface
{
    public function __construct(
        private string $name,
        private Poster|null $poster = null,
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPoster(): ?Poster
    {
        return $this->poster;
    }
}