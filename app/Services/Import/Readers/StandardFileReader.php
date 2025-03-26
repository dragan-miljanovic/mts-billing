<?php

namespace App\Services\Import\Readers;

use App\Services\Import\Contracts\FileReaderInterface;
use RuntimeException;

class StandardFileReader implements FileReaderInterface
{
    /**
     * Read file content
     *
     * @param string $file
     * @return string
     * @throws RuntimeException
     */
    public function read(string $file): string
    {
        if (!file_exists($file)) {
            throw new RuntimeException("File not found: $file");
        }

        $data = file_get_contents($file);
        if ($data === false) {
            throw new RuntimeException("Error reading file: $file");
        }

        return $data;
    }
}
