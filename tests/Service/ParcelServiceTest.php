<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Dto\Create\CreateParcelDto;
use App\Entity\Parcel;
use App\Factory\ValueObject\DimensionsFactory;
use App\Factory\ValueObject\RecipientFactory;
use App\Factory\ValueObject\SenderFactory;
use App\Model\Response\ParcelCreateResponse;
use App\Repository\ParcelRepository;
use App\Service\ParcelService;
use App\ValueObject\Address;
use App\ValueObject\Dimensions;
use App\ValueObject\FullName;
use App\ValueObject\Recipient;
use App\ValueObject\Sender;
use PHPUnit\Framework\TestCase;

class ParcelServiceTest extends TestCase
{
    public function testGetParcelsBySenderPhone(): void
    {
        $parcelRepositoryStub = $this->createStub(ParcelRepository::class);

        $testData = [$this->createParcelOne()];
        $phone = '113-222';

        $parcelRepositoryStub->method('findParcelsBySenderPhone')
            ->with($phone)->willReturn($testData);

        $parcelService = new ParcelService($parcelRepositoryStub);

        $parcels = $parcelService->getParcelsBySenderPhone($phone);

        $this->assertEquals($testData, $parcels);
    }

    public function testGetParcelsByReceiverFullName(): void
    {
        $parcelRepositoryStub = $this->createStub(ParcelRepository::class);

        $testData = [$this->createParcelOne()];
        $fullName = 'JamesOlivie';

        $parcelRepositoryStub->method('findParcelsByReceiverFullName')
            ->with($fullName)->willReturn($testData);

        $parcelService = new ParcelService($parcelRepositoryStub);

        $parcels = $parcelService->getParcelsByReceiverFullName($fullName);

        $this->assertEquals($testData, $parcels);
    }

    public function testDeleteParcelWithExistingParcel(): void
    {
        $parcelRepositoryMock = $this->createMock(ParcelRepository::class);

        $parcel = new Parcel();

        $parcelRepositoryMock->expects($this->once())
            ->method('getParcelById')
            ->with(1)
            ->willReturn($parcel);

        $parcelRepositoryMock->expects($this->once())
            ->method('removeAndFlush')
            ->with($parcel);

        $parcelService = new ParcelService($parcelRepositoryMock);

        $parcelService->deleteParcel(1);
    }

    private function createParcelOne(): Parcel
    {
        $addressSend = $this->createAddress('USA', 'NewYork', 'Sender St', '1A', '115');
        $fullNameSend = $this->createFullName('James', 'Olivie', null);

        $addressRecip = $this->createAddress('Canada', 'Toronto', 'Will St', '3C', '78');
        $fullNameRecip = $this->createFullName('Matt', 'Clause', null);

        $sender = new Sender($fullNameSend, $addressSend, '113-222');
        $recipient = new Recipient($fullNameRecip, $addressRecip, '333-444');

        $parcel = new Parcel();
        $parcel->setId(1);
        $parcel->setSender($sender);
        $parcel->setRecipient($recipient);
        $parcel->setDimensions(new Dimensions(30, 30, 3, 10));
        $parcel->setEstimatedCost(2000);

        return $parcel;
    }

    private function createParcelTwo(): Parcel
    {
        $addressSend = $this->createAddress('USA', 'Boston', 'Sender St', '1A', '115');
        $addressRecip = $this->createAddress('Canada', 'Toronto', 'Mill St', '3C', '78');

        $fullNameSend = $this->createFullName('Molly', 'Dolly', null);
        $fullNameRecip = $this->createFullName('Arnold', 'Ross', null);

        $sender = new Sender($fullNameSend, $addressSend, '121-222');
        $recipient = new Recipient($fullNameRecip, $addressRecip, '335-444');

        $parcel = new Parcel();
        $parcel->setId(2);
        $parcel->setSender($sender);
        $parcel->setRecipient($recipient);
        $parcel->setDimensions(new Dimensions(10, 20, 50, 10));
        $parcel->setEstimatedCost(1000);

        return $parcel;
    }

    private function createAddress(
        string $country,
        string $city,
        string $street,
        string $houseNumber,
        string $apartmentNumber
    ): Address {
        return new Address($country, $city, $street, $houseNumber, $apartmentNumber);
    }

    private function createFullName(string $firstName, string $lastName, ?string $middleName): FullName
    {
        return new FullName($firstName, $lastName, $middleName);
    }
}
