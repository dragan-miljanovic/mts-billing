<?php

namespace App\Repositories;

use App\Models\Header;
use App\Repositories\Contracts\HeaderRepositoryInterface;

class HeaderRepository extends BaseRepository implements HeaderRepositoryInterface
{
    public function __construct(Header $model) {
        parent::__construct($model);
    }
}
