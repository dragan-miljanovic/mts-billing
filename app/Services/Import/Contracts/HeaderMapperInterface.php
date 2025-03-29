<?php

namespace App\Services\Import\Contracts;

use App\Exceptions\HeaderMappingException;
use App\Models\Header;

interface HeaderMapperInterface
{
    /**
     * Map raw data
     *
     * @param array $rawData
     * @return array
     * @throws HeaderMappingException
     */
    public function map(array $rawData): array;

    /**
     * Map raw data to Header model attributes
     *
     * @param array $rawData
     * @return array
     * @throws HeaderMappingException
     */
    public function mapToModel(array $rawData): Header;
}
