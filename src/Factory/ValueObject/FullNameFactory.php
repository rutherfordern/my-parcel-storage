<?php

namespace App\Factory\ValueObject;

use App\Dto\Create\CreateFullNameDto;
use App\ValueObject\FullName;

class FullNameFactory
{
    public function createFromDto(CreateFullNameDto $fullNameDto): FullName
    {
        return new FullName($fullNameDto->firstName, $fullNameDto->lastName, $fullNameDto->middleName);
    }
}
