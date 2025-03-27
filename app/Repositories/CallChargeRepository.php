<?php

namespace App\Repositories;

use App\Models\CallCharge;

class CallChargeRepository extends BaseRepository
{
    public function __construct(CallCharge $model) {
        parent::__construct($model);
    }
}
