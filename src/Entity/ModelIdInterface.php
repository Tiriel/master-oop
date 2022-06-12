<?php

namespace App\Entity;

interface ModelIdInterface
{
    public function getId(): ?int;

    public function setId(int $id): self;
}