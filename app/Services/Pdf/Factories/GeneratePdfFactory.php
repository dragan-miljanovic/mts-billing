<?php

namespace App\Services\Pdf\Factories;

use App\Repositories\Contracts\CallChargeRepositoryInterface;
use App\Services\Pdf\Contracts\GeneratePdfFactoryInterface;
use App\Services\Pdf\Enums\PdfTypeEnum;
use App\Services\Pdf\Strategies\CallChargeGenerateStrategy;
use App\Services\Pdf\Strategies\ConfirmationGenerateStrategy;
use InvalidArgumentException;

class GeneratePdfFactory implements GeneratePdfFactoryInterface
{
    public function __construct(
        private CallChargeRepositoryInterface $callChargeRepository
    ) {
        //
    }

    /**
     * Create the appropriate generate strategy based on type
     *
     * @param string $type
     * @return CallChargeGenerateStrategy|ConfirmationGenerateStrategy
     */
    public function createGenerateStrategy(string $type): CallChargeGenerateStrategy|ConfirmationGenerateStrategy
    {
        return match ($type) {
            PdfTypeEnum::Cdr->value => new CallChargeGenerateStrategy($this->callChargeRepository),
            PdfTypeEnum::Conf->value => new ConfirmationGenerateStrategy(),
            default => throw new InvalidArgumentException("Invalid import type: $type")
        };
    }
}
