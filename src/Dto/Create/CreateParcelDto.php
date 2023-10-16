<?php

declare(strict_types=1);

namespace App\Dto\Create;

use Symfony\Component\Validator\Constraints as Assert;

class CreateParcelDto
{
    #[Assert\NotBlank]
    public readonly CreateSenderDto $sender;

    #[Assert\NotBlank]
    public readonly CreateRecipientDto $recipient;

    #[Assert\NotBlank]
    public readonly CreateDimensionsDto $dimensions;

    #[Assert\NotBlank]
    public readonly ?int $estimatedCost;

    public function __construct(
        CreateSenderDto $sender,
        CreateRecipientDto $recipient,
        CreateDimensionsDto $dimensions,
        int $estimatedCost = null)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->dimensions = $dimensions;
        $this->estimatedCost = $estimatedCost;
    }
}
