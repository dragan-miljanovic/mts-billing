<?php

namespace App\Services\Import\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

trait ImportLogTrait
{
    private function createImportLog(Collection $mappedData, int $chunkSize): UuidInterface
    {
        $totalChunks = (int) ceil($mappedData->count() / $chunkSize);
        $uid = Str::uuid();

        $this->importLogRepository->create([
            'uid' => $uid,
            'total_chunks' => $totalChunks,
        ]);

        return $uid;
    }
}
