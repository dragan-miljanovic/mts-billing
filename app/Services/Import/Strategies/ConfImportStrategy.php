<?php

namespace App\Services\Import\Strategies;

use App\Jobs\ConfImport;
use App\Repositories\Contracts\ImportLogRepositoryInterface;
use App\Services\Import\Contracts\ImportStrategyInterface;
use App\Services\Import\Traits\ImportLogTrait;
use App\Utils\Contracts\LoggerInterface;

class ConfImportStrategy implements ImportStrategyInterface
{
    use ImportLogTrait;

    public function __construct(
        private LoggerInterface $logger,
        private ImportLogRepositoryInterface $importLogRepository
    ) {
    }

    /**
     * Process CONF import data
     *
     * @param array $data
     */
    public function process(array $data): void
    {
        $chunkSize = env('JOB_CHUNK_SIZE');
        $confData = collect($data);

        if (!$confData->isEmpty()) {
            $uid = $this->createImportLog($confData->count(), $chunkSize);

            $confData->chunk($chunkSize)->each(function ($collection) use ($uid) {
                ConfImport::dispatch($uid, $collection);

                $this->logger->info('Importing CDR record', ['record' => $collection->first()]);
            });
        }
    }
}
