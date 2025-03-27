<?php

namespace App\Services\Import\Contracts;

interface CallChargeMapperInterface
{
    /**
     * Map raw data to CallCharge model attributes
     *
     * @param array $rawData
     * @return array
     */
    public function mapToModel(array $rawData): array;
}
