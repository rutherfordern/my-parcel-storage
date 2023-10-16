<?php

declare(strict_types=1);

namespace App\Dto\Create;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAddressDto
{
    #[Assert\NotBlank]
    public readonly string $country;

    #[Assert\NotBlank]
    public readonly string $city;

    #[Assert\NotBlank]
    public readonly string $street;

    #[Assert\NotBlank]
    public readonly string $houseNumber;

    #[Assert\NotBlank]
    public readonly string $apartmentNumber;

    public function __construct(string $country, string $city, string $street, string $houseNumber, string $apartmentNumber)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
    }
}
