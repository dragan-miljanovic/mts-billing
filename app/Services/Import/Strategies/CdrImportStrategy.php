<?php

namespace App\Services\Import\Strategies;

use App\Services\Import\Contracts\ImportStrategyInterface;
use App\Utils\Contracts\LoggerInterface;

class CdrImportStrategy implements ImportStrategyInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     * Process CDR import data
     *
     * @param array $data
     */
    public function process(array $data): void
    {
        $cdrData = $data['CDR'] ?? [];

        // Implement CDR-specific import logic
        foreach ($cdrData as $record) {
            // Process each CDR record
            // Add logging, validation, database insertion, etc.
            $this->logger->info('Importing CDR record', ['record' => $record]);
        }
    }
}
