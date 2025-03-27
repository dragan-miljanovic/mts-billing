<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function find($id): ?Model;

    public function findBy(array $criteria): Collection;

    public function findOneBy(array $criteria): ?Model;

    public function findAll(): Collection;

    public function insert(array $attributes): bool;

    public function create(array $attributes): Model;

    public function update(Model $model, array $attributes): bool;
    public function updateOrCreate(array $attributes): Model;

    public function delete(Model $model): bool;
}
