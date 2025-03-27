<?php

namespace App\Repositories;

use App\Models\ImportLog;
use App\Repositories\Contracts\ImportLogRepositoryInterface;

class ImportLogRepository extends BaseRepository implements ImportLogRepositoryInterface
{
    public function __construct(ImportLog $model) {
        parent::__construct($model);
    }
}
