<?php

namespace App\Services\Import;

use App\Exceptions\CallChargeMappingException;
use App\Services\Import\Contracts\CallChargeMapperInterface;
use Carbon\Carbon;

class CallChargeMapperService implements CallChargeMapperInterface
{
    /**
     * Map raw data to CallCharge model attributes
     *
     * @param array $rawData
     * @return array
     * @throws CallChargeMappingException
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
     * @throws CallChargeMappingException
     */
    private function validateInputData(array $rawData): void
    {
        // Check if data array has expected length
        $expectedLength = 50; // Based on the provided data
        if (count($rawData) !== $expectedLength) {
            throw new CallChargeMappingException(
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
            'charge_mode' => 2,
            'sequence_total' => 3,
            'imsi' => 4,
            'calling_msisdn' => 5,
            'clip_suppress_number' => 6,
            'called_msisdn' => 7,
            'destination_network' => 8,
            'destination_zone' => 9,
            'traffic_type' => 10,
            'apn' => 11,
            'rating_group' => 12,
            'message_type_indicator' => 13,
            'bearer_type' => 14,
            'roaming' => 15,
            'subscriber_location' => 16,
            'location_network' => 17,
            'location_zone' => 18,
            'answer_time' => 19,
            'max_call_cost' => 20,
            'call_duration' => 21,
            'ticket_call_duration' => 22,
            'charged_duration' => 23,
            'ticket_charged_duration' => 24,
            'nr_of_segments' => 25,
            'transferred_units' => 26,
            'transferred_bytes' => 27,
            'ticket_transferred_bytes' => 28,
            'charged_bytes' => 29,
            'ticket_charged_bytes' => 30,
            'number_of_sms' => 31,
            'ticket_number_of_sms' => 32,
            'reference_number' => 33,
            'charge_free_action' => 34,
            'tariff' => 35,
            'pool_id' => 36,
            'account_descriptor_id' => 37,
            'account_reference_id' => 38,
            'account_difference' => 39,
            'charge_amount' => 40,
            'account_id' => 41,
            'currency' => 42,
            'closing_balance' => 43,
            'account_type' => 44,
            'crce_result_code' => 45,
            'rating_filter_id' => 46,
            'revenue_code' => 47,
            'transparent_data' => 48,
            'additional_rating_info' => 49
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
                'answer_time' => !empty($value) ? Carbon::parse($value)->toDateTimeString() : null,
                'roaming', 'clip_suppress_number', 'charge_free_action' => strtolower($value) === 'true',
                default => $value === '' ? null : $value,
            };

            $transformedData[$attribute] = $value;
        }

        return $transformedData;
    }
}
