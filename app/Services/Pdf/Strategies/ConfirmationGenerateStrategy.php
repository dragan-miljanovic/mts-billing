<?php

namespace App\Services\Pdf\Strategies;

use App\Services\Pdf\Contracts\PdfStrategyInterface;
use Illuminate\Http\Response;

class ConfirmationGenerateStrategy implements PdfStrategyInterface
{
    public function generate(int $id): Response
    {
        // TODO: Implement generate() method.
    }
}
