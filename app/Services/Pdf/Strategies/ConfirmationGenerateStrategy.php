<?php

namespace App\Services\Pdf\Strategies;

use App\Repositories\Contracts\ConfirmationRepositoryInterface;
use App\Services\Pdf\Contracts\PdfStrategyInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ConfirmationGenerateStrategy implements PdfStrategyInterface
{
    public function __construct(
        private ConfirmationRepositoryInterface $confirmationRepository,
    ) {
        //
    }

    public function generate(int $id): Response
    {
        $confirmation = $this->confirmationRepository->find($id);

        return Pdf::loadView('confirmation.pdf', compact('confirmation'))
            ->setPaper('A4', 'landscape')
            ->download('confirmation.pdf');
    }
}
