<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'record_version',
        'crce_operation',
        'active_feature',
        'sequence_total',
        'bundle_code',
        'opp_id',
        'service_type',
        'customer_care_user',
        'subscriber_language',
        'imsi',
        'account_status',
        'tariff',
        'new_tariff',
        'pool_id',
        'transaction_fee',
        'old_value',
        'new_value',
        'currency',
        'add_amount',
        'set_balance',
        'closing_balance',
        'account_id',
        'account_descriptor_id',
        'account_reference_id',
        'account_type',
        'account_limit',
        'fnf_action',
        'fnf_number',
        'billing_period_start_date',
        'billing_period_end_date',
        'subscriber_activation_date',
        'subscriber_expiry_date',
        'cost_control_limit_name',
        'revenue_code',
        'crce_result_code',
        'transparent_data',
    ];
}
