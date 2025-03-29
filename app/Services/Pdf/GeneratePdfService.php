<?php

namespace App\Services\Pdf;

use App\Services\Pdf\Contracts\GeneratePdfServiceInterface;
use App\Services\Pdf\Factories\GeneratePdfFactory;
use Illuminate\Http\Response;

class GeneratePdfService implements GeneratePdfServiceInterface
{
    public function __construct(
        private GeneratePdfFactory $factory,
    ) {
        //
    }

    public function generatePdf(string $type, int $id): Response
    {
        return $this->factory->createGenerateStrategy($type)->generate($id);
    }
}
