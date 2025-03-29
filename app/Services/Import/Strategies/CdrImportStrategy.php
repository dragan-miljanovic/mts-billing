<?php

namespace App\Services\Import\Strategies;

use App\Exceptions\ImportException;
use App\Jobs\CallChargeImport;
use App\Repositories\ImportLogRepository;
use App\Services\Import\Contracts\ImportStrategyInterface;
use App\Services\Import\Traits\ImportLogTrait;
use App\Utils\Contracts\LoggerInterface;

class CdrImportStrategy implements ImportStrategyInterface
{
    use ImportLogTrait;

    public function __construct(
        private LoggerInterface $logger,
        private ImportLogRepository $importLogRepository
    ) {
    }

    /**
     * Process CDR import data
     *
     * @param array $data
     */
    public function process(array $data): void
    {
        $chunkSize = env('JOB_CHUNK_SIZE');
        $cdrData = collect($data);


        if (!$cdrData->isEmpty()) {
            $uid = $this->createImportLog($cdrData->count(), $chunkSize);

            $cdrData->chunk($chunkSize)->each(function ($collection) use ($uid) {
                CallChargeImport::dispatch($uid, $collection);

                $this->logger->info('Importing CDR record', ['records' => $collection]);
            });

            return;
        }

        $this->logger->info('No data found for call charge import.');
    }
}
