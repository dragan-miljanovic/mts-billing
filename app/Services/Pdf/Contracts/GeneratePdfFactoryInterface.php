<?php

namespace App\Services\Pdf\Contracts;

use App\Services\Pdf\Strategies\CallChargeGenerateStrategy;
use App\Services\Pdf\Strategies\ConfirmationGenerateStrategy;

interface GeneratePdfFactoryInterface
{
    public function createGenerateStrategy(string $type): CallChargeGenerateStrategy|ConfirmationGenerateStrategy;
}
