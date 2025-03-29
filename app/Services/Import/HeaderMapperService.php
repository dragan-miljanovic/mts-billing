<?php

namespace App\Services\Import;

use App\Exceptions\HeaderMappingException;
use App\Models\Header;
use App\Services\Import\Contracts\HeaderMapperInterface;
use Carbon\Carbon;

class HeaderMapperService implements HeaderMapperInterface
{
    /**
     * Map raw data to Header model attributes
     *
     * @param array $rawData
     * @return array
     */
    public function map(array $rawData): array
    {
        // Validate input data
        $this->validateInputData($rawData);

        // Create mapping configuration
        $mappingConfig = $this->getAttributeMapping();

        // Transform raw data to model attributes
        return $this->transformData($rawData, $mappingConfig);
    }

    /**
     * Validate input data before mapping
     *
     * @param array $rawData
     * @throws HeaderMappingException
     */
    private function validateInputData(array $rawData): void
    {
        // Check if data array has expected length
        $expectedLength = 23;
        if (count($rawData) !== $expectedLength) {
            throw new HeaderMappingException(
                "Invalid data length. Expected $expectedLength elements, got " . count($rawData)
            );
        }
    }

    /**
     * Define attribute mapping configuration
     *
     * @return array
     */
    private function getAttributeMapping(): array
    {
        return [
            'version' => 0,
            'ticket_type_id' => 1,
            'success' => 2,
            'provider' => 3,
            'application' => 4,
            'ticket_type' => 5,
            'node_id' => 6,
            'ticket_timestamp' => 7,
            'session_creation_timestamp' => 8,
            'session_id' => 9,
            'transaction_id' => 10,
            'sequence_id' => 11,
            'subscriber_id' => 12,
            'subscriber_address' => 13,
            'subscriber_type' => 14,
            'subscriber_state' => 15,
            'subscriber_state_info' => 16,
            'language_id' => 17,
            'charge_notification' => 18,
            'error_code' => 19,
            'group_id' => 20,
            'billing_account_id' => 21,
            'customer_id' => 22,
        ];
    }

    /**
     * Transform raw data based on mapping configuration
     *
     * @param array $rawData
     * @param array $mappingConfig
     * @return array
     */
    private function transformData(array $rawData, array $mappingConfig): array
    {
        $transformedData = [];

        foreach ($mappingConfig as $attribute => $index) {
            $value = $rawData[$index];

            // Special transformations
            $value = match ($attribute) {
                'ticket_timestamp', 'session_creation_timestamp' => !empty($value) ? Carbon::parse($value)->toDateTimeString() : null,
                'success', 'charge_notification' => strtolower($value) === 'true',
                default => $value === '' ? null : $value,
            };

            $transformedData[$attribute] = $value;
        }

        return $transformedData;
    }

    public function mapToModel(array $rawData): Header
    {
        return new Header($rawData);
    }
}
