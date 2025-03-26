<?php

namespace App\Services\Import\Strategies;

use App\Repositories\ImportLogRepository;
use App\Services\Import\Contracts\ImportStrategyInterface;
use App\Services\Import\Traits\ImportLogTrait;
use App\Utils\Contracts\LoggerInterface;

class ConfImportStrategy implements ImportStrategyInterface
{
    use ImportLogTrait;

    public function __construct(
        private LoggerInterface $logger,
        private ImportLogRepository $importLogRepository
    ) {
    }

    /**
     * Process CONF import data
     *
     * @param array $data
     */
    public function process(array $data): void
    {
        $chunkSize = 1;
        $confData = collect($data['CONF'] ?? []);

        if (!$confData->isEmpty()) {
            $uid = $this->createImportLog($confData, $chunkSize);

            $confData->chunk($chunkSize)->each(function ($record) {


                $this->logger->info('Importing CDR record', ['record' => $record]);
            });
        }
    }
}
