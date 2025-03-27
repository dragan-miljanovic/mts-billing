<?php

namespace App\Repositories;

use App\Models\Confirmation;

class ConfirmationRepository extends BaseRepository
{
    public function __construct(Confirmation $model) {
        parent::__construct($model);
    }
}
