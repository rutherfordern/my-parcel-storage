<?php

declare(strict_types=1);

namespace App\Dto\Create;

use Symfony\Component\Validator\Constraints as Assert;

class CreateFullNameDto
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public readonly string $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public readonly string $lastName;

    public readonly ?string $middleName;

    public function __construct(string $firstName, string $lastName, string $middleName = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
    }
}
