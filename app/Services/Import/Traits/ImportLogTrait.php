<?php

namespace App\Services\Import\Traits;

use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

trait ImportLogTrait
{
    private function createImportLog(int $totalData, int $chunkSize): UuidInterface
    {
        $totalChunks = (int) ceil($totalData / $chunkSize);
        $uid = Str::uuid();

        $this->importLogRepository->create([
            'uid' => $uid,
            'total_chunks' => $totalChunks,
        ]);

        return $uid;
    }
}
