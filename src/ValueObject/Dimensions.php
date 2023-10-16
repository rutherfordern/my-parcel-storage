<?php

declare(strict_types=1);

namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;
use Symfony\Component\Validator\Constraints as Assert;

#[Embeddable]
final class Dimensions
{
    #[ORM\Column]
    #[Assert\NotBlank]
    private int $weight;

    #[ORM\Column]
    #[Assert\NotBlank]
    private int $length;

    #[ORM\Column]
    #[Assert\NotBlank]
    private int $height;

    #[ORM\Column]
    #[Assert\NotBlank]
    private int $width;

    public function __construct(int $weight, int $length, int $height, int $width)
    {
        $this->weight = $weight;
        $this->length = $length;
        $this->height = $height;
        $this->width = $width;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }
}
