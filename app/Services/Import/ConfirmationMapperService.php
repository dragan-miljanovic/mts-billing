<?php

namespace App\Services\Import;

use App\Exceptions\ConfirmationMappingException;
use App\Services\Import\Contracts\ConfirmationMapperInterface;
use Carbon\Carbon;

class ConfirmationMapperService implements ConfirmationMapperInterface
{
    /**
     * Map raw data to Confirmation model attributes
     *
     * @param array $rawData
     * @return array
     * @throws ConfirmationMappingException
     */
    public function mapToModel(array $rawData): array
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
     * @throws ConfirmationMappingException
     */
    private function validateInputData(array $rawData): void
    {
        // Check if data array has expected length
        $expectedLength = 36;
        if (count($rawData) !== $expectedLength) {
            throw new ConfirmationMappingException(
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
            'record_version' => 0,
            'crce_operation' => 1,
            'active_feature' => 2,
            'sequence_total' => 3,
            'bundle_code' => 4,
            'opp_id' => 5,
            'service_type' => 6,
            'customer_care_user' => 7,
            'subscriber_language' => 8,
            'imsi' => 9,
            'account_status' => 10,
            'tariff' => 11,
            'new_tariff' => 12,
            'pool_id' => 13,
            'transaction_fee' => 14,
            'old_value' => 15,
            'new_value' => 16,
            'currency' => 17,
            'add_amount' => 18,
            'set_balance' => 19,
            'closing_balance' => 20,
            'account_id' => 21,
            'account_descriptor_id' => 22,
            'account_reference_id' => 23,
            'account_type' => 24,
            'account_limit' => 25,
            'fnf_action' => 26,
            'fnf_number' => 27,
            'billing_period_start_date' => 28,
            'billing_period_end_date' => 29,
            'subscriber_activation_date' => 30,
            'subscriber_expiry_date' => 31,
            'cost_control_limit_name' => 32,
            'revenue_code' => 33,
            'crce_result_code' => 34,
            'transparent_data' => 35
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
            // Trim empty strings, convert to null
            if ($attribute === 'subscriber_activation_date') {
                $value = Carbon::parse($rawData[$index])->toDateTimeString();
            } else {
                $value = $rawData[$index];
            }

            $transformedData[$attribute] = $value === '' ? null : $value;
        }

        return $transformedData;
    }
}
