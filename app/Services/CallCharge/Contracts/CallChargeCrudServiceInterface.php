<?php

namespace App\Services\CallCharge\Contracts;

use App\Models\CallCharge;
use Illuminate\Pagination\LengthAwarePaginator;

interface CallChargeCrudServiceInterface
{
    public function find(int $id): CallCharge;

    public function findAllWithPagination(int $number): LengthAwarePaginator;

    public function delete(int $id): void;
}
