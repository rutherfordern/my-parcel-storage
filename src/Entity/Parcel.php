<?php

namespace App\Entity;

use App\Repository\ParcelRepository;
use App\ValueObject\Dimensions;
use App\ValueObject\Recipient;
use App\ValueObject\Sender;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;

#[ORM\Entity(repositoryClass: ParcelRepository::class)]
class Parcel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Embedded(class: Sender::class)]
    private ?Sender $sender = null;

    #[Embedded(class: Recipient::class)]
    private ?Recipient $recipient = null;

    #[Embedded(class: Dimensions::class)]
    private ?Dimensions $dimensions = null;

    #[ORM\Column(nullable: true)]
    private ?int $estimatedCost = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSender(): ?Sender
    {
        return $this->sender;
    }

    public function setSender(?Sender $sender): void
    {
        $this->sender = $sender;
    }

    public function getRecipient(): ?Recipient
    {
        return $this->recipient;
    }

    public function setRecipient(?Recipient $recipient): void
    {
        $this->recipient = $recipient;
    }

    public function getDimensions(): ?Dimensions
    {
        return $this->dimensions;
    }

    public function setDimensions(?Dimensions $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    public function getEstimatedCost(): ?int
    {
        return $this->estimatedCost;
    }

    public function setEstimatedCost(?int $estimatedCost): void
    {
        $this->estimatedCost = $estimatedCost;
    }
}
