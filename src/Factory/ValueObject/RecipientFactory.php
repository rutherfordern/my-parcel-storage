<?php

declare(strict_types=1);

namespace App\Factory\ValueObject;

use App\Dto\Create\CreateRecipientDto;
use App\ValueObject\Recipient;

class RecipientFactory
{
    public function __construct(
        private FullNameFactory $fullNameFactory,
        private AddressFactory $addressFactory,
    ) {
    }

    public function createFromDto(CreateRecipientDto $recipientDto): Recipient
    {
        $fullName = $this->fullNameFactory->createFromDto($recipientDto->fullName);
        $address = $this->addressFactory->createFromDto($recipientDto->address);
        $phone = $recipientDto->phone;

        return new Recipient($fullName, $address, $phone);
    }
}
