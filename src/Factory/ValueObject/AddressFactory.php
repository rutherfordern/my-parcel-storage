<?php

namespace App\Factory\ValueObject;

use App\Dto\Create\CreateAddressDto;
use App\ValueObject\Address;

class AddressFactory
{
    public function createFromDto(CreateAddressDto $addressDto): Address
    {
        return new Address(
            $addressDto->country,
            $addressDto->city,
            $addressDto->street,
            $addressDto->houseNumber,
            $addressDto->apartmentNumber,
        );
    }
}
