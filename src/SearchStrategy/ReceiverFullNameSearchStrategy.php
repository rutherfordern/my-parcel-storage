<?php

declare(strict_types=1);

namespace App\SearchStrategy;

use App\Service\ParcelService;

class ReceiverFullNameSearchStrategy implements SearchStrategyInterface
{
    public function __construct(
        private readonly ParcelService $parcelService,
    ) {
    }

    public function search(string $query): array
    {
        return $this->parcelService->getParcelsByReceiverFullName($query);
    }
}
