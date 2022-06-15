<?php

namespace App\Transformer;

use App\Entity\ModelIdInterface;
use App\Model\EntityModelInterface;

interface TransformerInterface
{
    public function toEntity(EntityModelInterface $model);

    public function fromEntity(ModelIdInterface $entity);
}