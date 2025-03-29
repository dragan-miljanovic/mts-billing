<?php

namespace App\Services\CallCharge;

use App\Models\CallCharge;
use App\Repositories\Contracts\CallChargeRepositoryInterface;
use App\Services\CallCharge\Contracts\CallChargeCrudServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class CallChargeCrudService implements CallChargeCrudServiceInterface
{
    public function __construct(
        private CallChargeRepositoryInterface $callChargeRepository,
    ){
        //
    }

    public function find(int $id): CallCharge
    {
        /** @var CallCharge $callCharge */
        $callCharge = $this->callChargeRepository->find($id);

        return $callCharge;
    }

    public function findAllWithPagination(int $number): LengthAwarePaginator
    {
        return $this->callChargeRepository->findAllWithPagination($number);
    }

    public function delete(int $id): void
    {
        $callCharge = $this->callChargeRepository->find($id);

        if (!$callCharge) {
            throw new ModelNotFoundException('CallCharge not found for id ' . $id);
        }

        $this->callChargeRepository->delete($callCharge);
    }
}
