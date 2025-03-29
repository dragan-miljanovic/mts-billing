<?php

namespace App\Services\Pdf\Strategies;

use App\Repositories\Contracts\CallChargeRepositoryInterface;
use App\Services\Pdf\Contracts\PdfStrategyInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class CallChargeGenerateStrategy implements PdfStrategyInterface
{
    public function __construct(
        private CallChargeRepositoryInterface $callChargeRepository,
    ) {
        //
    }

    public function generate(int $id): Response
    {
        $callCharge = $this->callChargeRepository->find($id);

        return Pdf::loadView('call-charge.pdf', compact('callCharge'))
            ->setPaper('A4', 'landscape')
            ->download('call-charge.pdf');
    }
}
