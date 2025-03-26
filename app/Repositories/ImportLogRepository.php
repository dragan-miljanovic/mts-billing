<?php

namespace App\Repositories;

use App\Models\ImportLog;

class ImportLogRepository extends BaseRepository
{
    public function __construct(ImportLog $model) {
        parent::__construct($model);
    }
}
