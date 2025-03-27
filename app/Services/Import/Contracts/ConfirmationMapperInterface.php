<?php

namespace App\Services\Import\Contracts;

interface ConfirmationMapperInterface
{
    /**
     * Map raw data to Confirmation model
     *
     * @param array $rawData
     * @return array
     */
    public function mapToModel(array $rawData): array;
}
