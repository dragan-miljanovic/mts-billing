<?php

namespace App\Services\Pdf\Contracts;

use Illuminate\Http\Response;

interface GeneratePdfServiceInterface
{
    public function generatePdf(string $type, int $id): Response;
}
