<?php

declare(strict_types=1);

namespace App\Dto\Create;

use Symfony\Component\Validator\Constraints as Assert;

class CreateSenderDto
{
    #[Assert\NotBlank]
    public readonly CreateFullNameDto $fullName;

    #[Assert\NotBlank]
    public readonly CreateAddressDto $address;

    #[Assert\NotBlank]
    public readonly string $phone;

    public function __construct(CreateFullNameDto $fullName, CreateAddressDto $address, string $phone)
    {
        $this->fullName = $fullName;
        $this->address = $address;
        $this->phone = $phone;
    }
}
