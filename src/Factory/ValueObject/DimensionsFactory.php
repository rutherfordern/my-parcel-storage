<?php

namespace App\Factory\ValueObject;

use App\Dto\Create\CreateDimensionsDto;
use App\ValueObject\Dimensions;

class DimensionsFactory
{
    public function createFromDto(CreateDimensionsDto $dimensionsDto): Dimensions
    {
        return new Dimensions(
            $dimensionsDto->weight,
            $dimensionsDto->length,
            $dimensionsDto->height,
            $dimensionsDto->width
        );
    }
}
