<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find($id): ?Model
    {
        return $this->model->query()->find($id);
    }

    public function findBy(array $criteria): Collection
    {
        return $this->model->query()->where($criteria)->get();
    }

    public function findOneBy(array $criteria): ?Model
    {
        return $this->model->query()->where($criteria)->first();
    }

    public function findAll(): Collection
    {
        return $this->model->all();
    }

    public function findAllWithPagination(int $id): LengthAwarePaginator
    {
        return $this->model->paginate($id);
    }

    public function insert(array $attributes): bool
    {
        return $this->model->query()->insert($attributes);
    }

    public function create(array $attributes): Model
    {
        return $this->model->query()->create($attributes);
    }

    public function update(Model $model, array $attributes): bool
    {
        return $model->update($attributes);
    }

    public function updateOrCreate(array $attributes): Model
    {
        return $this->model->query()->updateOrCreate($attributes);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}
