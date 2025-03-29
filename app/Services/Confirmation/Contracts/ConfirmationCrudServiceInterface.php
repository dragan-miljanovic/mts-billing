<?php

namespace App\Services\Confirmation\Contracts;

use App\Models\Confirmation;
use Illuminate\Pagination\LengthAwarePaginator;

interface ConfirmationCrudServiceInterface
{
    public function find(int $id): Confirmation;

    public function findAllWithPagination(int $number): LengthAwarePaginator;

    public function delete(int $id): void;
}
