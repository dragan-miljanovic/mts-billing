<?php

namespace App\Services\Pdf\Contracts;

use Illuminate\Http\Response;

interface PdfStrategyInterface
{
    /**
     * Generate file
     *
     * @param array $data
     */
    public function generate(int $id): Response;
}
