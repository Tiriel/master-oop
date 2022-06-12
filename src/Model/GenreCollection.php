<?php

namespace App\Model;

use App\Entity\Genre as GenreEntity;
use Doctrine\Common\Collections\ArrayCollection;

class GenreCollection extends ArrayCollection
{
    public function __construct(ArrayCollection $genres)
    {
        $elements = [];
        foreach ($genres as $genre) {
            /** @var GenreEntity $genre */
            $elements[] = new Genre(
                new Id($genre->getId()),
                $genre->getName()
            );
        }
        parent::__construct($elements);
    }
}