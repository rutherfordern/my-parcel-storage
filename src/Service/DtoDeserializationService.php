<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Create\CreateAddressDto;
use App\Dto\Create\CreateDimensionsDto;
use App\Dto\Create\CreateFullNameDto;
use App\Dto\Create\CreateParcelDto;
use App\Dto\Create\CreateRecipientDto;
use App\Dto\Create\CreateSenderDto;
use App\Exception\ValidationException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoDeserializationService
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator)
    {
    }

    public function deserializeParcelCreateDtoFromJson(string $jsonData): CreateParcelDto
    {
        $data = json_decode($jsonData, true);

        if (null === $data) {
            throw new \InvalidArgumentException('Invalid JSON data');
        }

        $senderDto = $this->deserializeSenderDto($data['sender']);
        $recipientDto = $this->deserializeRecipientDto($data['recipient']);
        $dimensionsDto = $this->deserializeDimensionsDto($data['dimensions']);
        $estimatedCost = $data['estimatedCost'];

        $createParcelDto = new CreateParcelDto($senderDto, $recipientDto, $dimensionsDto, $estimatedCost);

        $this->validateDto($createParcelDto);

        return $createParcelDto;
    }

    private function deserializeSenderDto(array $data): CreateSenderDto
    {
        $fullNameDto = $this->deserializeFullNameDto($data['fullName']);
        $addressDto = $this->deserializeAddressDto($data['address']);
        $phone = $data['phone'];

        $senderDto = new CreateSenderDto($fullNameDto, $addressDto, $phone);

        $this->validateDto($senderDto);

        return $senderDto;
    }

    private function deserializeRecipientDto(array $data): CreateRecipientDto
    {
        $fullNameDto = $this->deserializeFullNameDto($data['fullName']);
        $addressDto = $this->deserializeAddressDto($data['address']);
        $phone = $data['phone'];

        $recipientDto = new CreateRecipientDto($fullNameDto, $addressDto, $phone);

        $this->validateDto($recipientDto);

        return $recipientDto;
    }

    private function deserializeFullNameDto(array $data): CreateFullNameDto
    {
        $dto = $this->serializer->denormalize($data, CreateFullNameDto::class);

        $this->validateDto($dto);

        return $dto;
    }

    private function deserializeAddressDto(array $data): CreateAddressDto
    {
        $dto = $this->serializer->denormalize($data, CreateAddressDto::class);

        $this->validateDto($dto);

        return $dto;
    }

    private function deserializeDimensionsDto(array $data): CreateDimensionsDto
    {
        $dto = $this->serializer->denormalize($data, CreateDimensionsDto::class);

        $this->validateDto($dto);

        return $dto;
    }

    private function validateDto($dto): void
    {
        $errors = $this->validator->validate($dto);

        if (\count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}
