<?php

namespace App\Services\Import;

use App\Services\Import\Contracts\ImportFactoryInterface;
use App\Services\Import\Strategies\CdrImportStrategy;
use App\Services\Import\Strategies\ConfImportStrategy;
use App\Utils\Contracts\LoggerInterface;
use InvalidArgumentException;

class ImportFactory implements ImportFactoryInterface
{

    public function __construct(
        private LoggerInterface $logger,
    ) {}
    /**
     * Create the appropriate import strategy based on type
     *
     * @param string $type
     * @return CdrImportStrategy|ConfImportStrategy
     * @throws InvalidArgumentException
     */
    public function createImportStrategy(string $type): CdrImportStrategy|ConfImportStrategy
    {
        return match (strtoupper($type)) {
            'CDR' => new CdrImportStrategy($this->logger),
            'CONF' => new ConfImportStrategy($this->logger),
            default => throw new InvalidArgumentException("Invalid import type: $type")
        };
    }
}
