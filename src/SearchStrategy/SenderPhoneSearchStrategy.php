<?php

declare(strict_types=1);

namespace App\SearchStrategy;

use App\Service\ParcelService;

class SenderPhoneSearchStrategy implements SearchStrategyInterface
{
    public function __construct(
        private ParcelService $parcelService,
    ) {
    }

    public function search(string $query): array
    {
        return $this->parcelService->getParcelsBySenderPhone($query);
    }
}
