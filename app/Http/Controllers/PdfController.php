<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CallChargeRepositoryInterface;
use App\Repositories\Contracts\ConfirmationRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfController extends Controller
{
    public function __construct(
        private CallChargeRepositoryInterface $callChargeRepository,
        private ConfirmationRepositoryInterface $confirmationRepository,
    ) {
        //
    }

    public function generate(): Response
    {
        $confirmations = $this->confirmationRepository->findAll();
        $callCharges = $this->callChargeRepository->findAll();

        return Pdf::loadView('pdf', compact('confirmations', 'callCharges'))
            ->setPaper('A0', 'landscape')
            ->download('invoice.pdf');
    }
}
