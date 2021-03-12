<?php

namespace Dtos;

use Interfaces\ElementDtoInterface;

class ElementDto implements ElementDtoInterface
{
    public int $weight;
    public int $height;
    public int $depth;

    public function __construct(int $weight, int $height, int $depth)
    {
        $this->weight = $weight;
        $this->height = $height;
        $this->depth = $depth;
    }
}