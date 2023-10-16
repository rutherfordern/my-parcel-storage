<?php

declare(strict_types=1);

namespace App\Factory\Search;

class SearchStrategyFactory
{
    public function __construct(private array $strategies)
    {
    }

    public function createStrategy(string $searchType)
    {
        if (\array_key_exists($searchType, $this->strategies)) {
            return $this->strategies[$searchType];
        }

        throw new \InvalidArgumentException('Invalid searchType');
    }
}
