<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Create\CreateParcelDto;
use App\Entity\Parcel;
use App\Factory\ValueObject\DimensionsFactory;
use App\Factory\ValueObject\RecipientFactory;
use App\Factory\ValueObject\SenderFactory;
use App\Model\Response\ParcelCreateResponse;
use App\Repository\ParcelRepository;

class ParcelService
{
    public function __construct(
        private ParcelRepository $parcelRepository,
        private SenderFactory $senderFactory,
        private RecipientFactory $recipientFactory,
        private DimensionsFactory $dimensionsFactory,
    ) {
    }

    public function createParcel(CreateParcelDto $createParcelDto): ParcelCreateResponse
    {
        $sender = $this->senderFactory->createFromDto($createParcelDto->sender);
        $recipient = $this->recipientFactory->createFromDto($createParcelDto->recipient);
        $dimensions = $this->dimensionsFactory->createFromDto($createParcelDto->dimensions);

        $parcel = new Parcel();

        $parcel->setSender($sender);
        $parcel->setRecipient($recipient);
        $parcel->setDimensions($dimensions);
        $parcel->setEstimatedCost($createParcelDto->estimatedCost);

        $this->parcelRepository->saveAndFlush($parcel);

        return new ParcelCreateResponse($parcel->getId());
    }

    public function getParcelsBySenderPhone(string $phone): array
    {
        return $this->parcelRepository->findParcelsBySenderPhone($phone);
    }

    public function getParcelsByReceiverFullName(string $fullName): array
    {
        return $this->parcelRepository->findParcelsByReceiverFullName($fullName);
    }

    public function deleteParcel(int $id): void
    {
        $parcel = $this->parcelRepository->getParcelById($id);

        $this->parcelRepository->removeAndFlush($parcel);
    }
}
