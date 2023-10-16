<?php

declare(strict_types=1);

namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;
use Symfony\Component\Validator\Constraints as Assert;

#[Embeddable]
final class FullName
{
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private string $lastName;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $middleName = null;

    public function __construct(string $firstName, string $lastName, ?string $middleName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }
}
