<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Header extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'version',
        'ticket_type_id',
        'success',
        'provider',
        'application',
        'ticket_type',
        'node_id',
        'ticket_timestamp',
        'session_creation_timestamp',
        'session_id',
        'transaction_id',
        'sequence_id',
        'subscriber_id',
        'subscriber_address',
        'subscriber_type',
        'subscriber_state',
        'subscriber_state_info',
        'language_id',
        'charge_notification',
        'error_code',
        'group_id',
        'billing_account_id',
        'customer_id',
    ];


    // The morphTo relation
    public function headerable(): MorphTo
    {
        return $this->morphTo();
    }
}
