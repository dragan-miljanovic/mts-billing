<?php

namespace App\Services\Import;

use App\Repositories\ImportLogRepository;
use App\Services\Import\Contracts\ImportFactoryInterface;
use App\Services\Import\Strategies\CdrImportStrategy;
use App\Services\Import\Strategies\ConfImportStrategy;
use App\Utils\Contracts\LoggerInterface;
use InvalidArgumentException;

class ImportFactory implements ImportFactoryInterface
{

    public function __construct(
        private LoggerInterface $logger,
        private ImportLogRepository $importLogRepository
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
            'CDR' => new CdrImportStrategy($this->logger, $this->importLogRepository),
            'CONF' => new ConfImportStrategy($this->logger, $this->importLogRepository),
            default => throw new InvalidArgumentException("Invalid import type: $type")
        };
    }
}
