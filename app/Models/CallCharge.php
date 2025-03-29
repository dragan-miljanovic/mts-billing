<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CallCharge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'record_version',
        'crce_operation',
        'charge_mode',
        'sequence_total',
        'imsi',
        'calling_msisdn',
        'clip_suppress_number',
        'called_msisdn',
        'destination_network',
        'destination_zone',
        'traffic_type',
        'apn',
        'rating_group',
        'message_type_indicator',
        'bearer_type',
        'roaming',
        'subscriber_location',
        'location_network',
        'location_zone',
        'answer_time',
        'max_call_cost',
        'call_duration',
        'ticket_call_duration',
        'charged_duration',
        'ticket_charged_duration',
        'nr_of_segments',
        'transferred_units',
        'transferred_bytes',
        'ticket_transferred_bytes',
        'charged_bytes',
        'ticket_charged_bytes',
        'number_of_sms',
        'ticket_number_of_sms',
        'reference_number',
        'charge_free_action',
        'tariff',
        'pool_id',
        'account_descriptor_id',
        'account_reference_id',
        'account_difference',
        'charge_amount',
        'account_id',
        'currency',
        'closing_balance',
        'account_type',
        'crce_result_code',
        'rating_filter_id',
        'revenue_code',
        'transparent_data',
        'additional_rating_info',
    ];

    public function header(): MorphOne
    {
        return $this->morphOne(Header::class, 'headerable');
    }
}
