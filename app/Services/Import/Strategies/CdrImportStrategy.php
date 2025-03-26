<?php

namespace App\Services\Import\Strategies;

use App\Services\Import\Contracts\ImportStrategyInterface;
use App\Services\Import\Traits\ImportLogTrait;
use App\Utils\Contracts\LoggerInterface;

class CdrImportStrategy implements ImportStrategyInterface
{
    use ImportLogTrait;

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
        $chunkSize = 1;
        $cdrData = collect($data['CDR'] ?? []);

        if (!$cdrData->isEmpty()) {
            $uid = $this->createImportLog($cdrData, $chunkSize);

            $cdrData->chunk($chunkSize)->each(function ($record) {


                $this->logger->info('Importing CDR record', ['record' => $record]);
            });
        }
    }
}
