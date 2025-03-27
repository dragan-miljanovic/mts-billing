<?php

namespace App\Repositories;

use App\Models\Confirmation;
use App\Repositories\Contracts\ConfirmationRepositoryInterface;

class ConfirmationRepository extends BaseRepository implements ConfirmationRepositoryInterface
{
    public function __construct(Confirmation $model) {
        parent::__construct($model);
    }
}
