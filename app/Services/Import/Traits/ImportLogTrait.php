<?php

namespace App\Services\Import\Traits;

use App\Repositories\ImportLogRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

trait ImportLogTrait
{
    private function createImportLog(Collection $mappedData, int $chunkSize): UuidInterface
    {
        $totalChunks = (int) ceil($mappedData->count() / $chunkSize);
        $uid = Str::uuid();

        app(ImportLogRepository::class)->create([
            'uid' => $uid,
            'total_chunks' => $totalChunks,
        ]);

        return $uid;
    }
}
