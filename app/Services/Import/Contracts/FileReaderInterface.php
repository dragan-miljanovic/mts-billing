<?php

namespace App\Services\Import\Contracts;

interface FileReaderInterface
{
    /**
     * Read file content
     *
     * @param string $file
     * @return string
     * @throws \RuntimeException
     */
    public function read(string $file): array;
}
