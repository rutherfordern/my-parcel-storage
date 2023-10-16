<?php

declare(strict_types=1);

namespace App\Dto\Create;

use Symfony\Component\Validator\Constraints as Assert;

class CreateDimensionsDto
{
    #[Assert\NotBlank]
    public readonly int $weight;

    #[Assert\NotBlank]
    public readonly int $length;

    #[Assert\NotBlank]
    public readonly int $height;

    #[Assert\NotBlank]
    public readonly int $width;

    public function __construct(int $weight, int $length, int $height, int $width)
    {
        $this->weight = $weight;
        $this->length = $length;
        $this->height = $height;
        $this->width = $width;
    }
}
