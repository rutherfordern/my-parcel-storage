<?php

namespace App\Model\Response;

class ParcelListResponse
{
    public function __construct(private readonly array $items)
    {
    }
}
