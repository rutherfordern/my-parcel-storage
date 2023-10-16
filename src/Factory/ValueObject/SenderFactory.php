<?php

declare(strict_types=1);

namespace App\Factory\ValueObject;

use App\Dto\Create\CreateSenderDto;
use App\ValueObject\Sender;

class SenderFactory
{
    public function __construct(
        private FullNameFactory $fullNameFactory,
        private AddressFactory $addressFactory,
    ) {
    }

    public function createFromDto(CreateSenderDto $senderDto): Sender
    {
        $fullName = $this->fullNameFactory->createFromDto($senderDto->fullName);
        $address = $this->addressFactory->createFromDto($senderDto->address);
        $phone = $senderDto->phone;

        return new Sender($fullName, $address, $phone);
    }
}
