<?php

declare(strict_types=1);

namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Embedded;
use Symfony\Component\Validator\Constraints as Assert;

#[Embeddable]
final class Sender
{
    #[Embedded(class: FullName::class)]
    private FullName $fullName;

    #[Embedded(class: Address::class)]
    private Address $address;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private string $phone;

    public function __construct(FullName $fullName, Address $address, string $phone)
    {
        $this->fullName = $fullName;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function getFullName(): FullName
    {
        return $this->fullName;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
