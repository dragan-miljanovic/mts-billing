<?php

namespace App\Services\Import\Strategies;

use App\Services\Import\Contracts\ImportStrategyInterface;
use App\Utils\Contracts\LoggerInterface;

class ConfImportStrategy implements ImportStrategyInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     * Process CONF import data
     *
     * @param array $data
     */
    public function process(array $data): void
    {
        $confData = $data['CONF'] ?? [];

        // Implement CONF-specific import logic
        foreach ($confData as $record) {
            // Process each CONF record
            // Add logging, validation, database insertion, etc.
            $this->logger?->info('Importing CONF record', ['record' => $record]);
        }
    }
}
