<?php

namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;
use Symfony\Component\Validator\Constraints as Assert;

#[Embeddable]
final class Address
{
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private string $country;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private string $city;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private string $street;

    #[ORM\Column]
    #[Assert\NotBlank]
    private string $houseNumber;

    #[ORM\Column]
    #[Assert\NotBlank]
    private string $apartmentNumber;

    public function __construct(string $country, string $city, string $street, string $houseNumber, string $apartmentNumber)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getApartmentNumber(): string
    {
        return $this->apartmentNumber;
    }
}
