<?php

namespace App\Services\Confirmation;

use App\Models\Confirmation;
use App\Repositories\Contracts\ConfirmationRepositoryInterface;
use App\Services\Confirmation\Contracts\ConfirmationCrudServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class ConfirmationCrudService implements ConfirmationCrudServiceInterface
{
    public function __construct(
        private ConfirmationRepositoryInterface $confirmationRepository,
    ){
        //
    }

    public function find(int $id): Confirmation
    {
        /** @var Confirmation $confirmation */
        $confirmation = $this->confirmationRepository->find($id);

        return $confirmation;
    }

    public function findAllWithPagination(int $number): LengthAwarePaginator
    {
        return $this->confirmationRepository->findAllWithPagination($number);
    }

    public function delete(int $id): void
    {
        $confirmation = $this->confirmationRepository->find($id);

        if (!$confirmation) {
            throw new ModelNotFoundException('CallCharge not found for number ' . $id);
        }

        $this->confirmationRepository->delete($confirmation);
    }
}
