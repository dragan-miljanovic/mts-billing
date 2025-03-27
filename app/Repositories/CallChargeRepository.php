<?php

namespace App\Repositories;

use App\Models\CallCharge;
use App\Repositories\Contracts\CallChargeRepositoryInterface;

class CallChargeRepository extends BaseRepository implements CallChargeRepositoryInterface
{
    public function __construct(CallCharge $model) {
        parent::__construct($model);
    }
}
