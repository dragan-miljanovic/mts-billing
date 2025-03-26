<?php

namespace App\Services\Import;

use App\Services\Import\Contracts\FileReaderInterface;
use App\Services\Import\Contracts\ImportFactoryInterface;
use App\Services\Import\Enums\ImportTypeEnum;
use InvalidArgumentException;

class ImportService
{
    public function __construct(
        private FileReaderInterface $fileReader,
        private ImportFactoryInterface $importFactory,
    ) {
    }

    /**
     * Import file using the specified strategy
     *
     * @param string $file Path to the file to import
     * @param string $type Type of import (CDR or CONF)
     * @throws InvalidArgumentException
     */
    public function import(string $file): void
    {
        $cdrType = ImportTypeEnum::Cdr->value;
        $confType = ImportTypeEnum::Conf->value;
        // Read the file content
        $data = $this->fileReader->read($file);
        // Process the data
        $processedData = $this->parseData($data);

        // Import the processed data
        $this->importFactory->createImportStrategy($cdrType)->process($processedData[$cdrType]);
        $this->importFactory->createImportStrategy($confType)->process($processedData[$confType]);
    }

    /**
     * Parse the raw data into structured records
     *
     * @param string $data
     * @return array
     */
    private function parseData(string $data): array
    {
        $records = explode("\n", $data);
        $cdrType = ImportTypeEnum::Cdr->value;
        $confType = ImportTypeEnum::Conf->value;
        $parsedData = [
            $cdrType => [],
            $confType => []
        ];
        $currentCategory = null;

        foreach ($records as $line) {
            if (str_contains($line, '#CRCE CDR')) {
                $currentCategory = $cdrType;
            } elseif (str_contains($line, '#CRCE CONF')) {
                $currentCategory = $confType;
            } elseif ($currentCategory && !empty(trim($line))) {
                $parsedData[$currentCategory][] = array_slice(explode('|', $line), 23);
            }
        }

        return $parsedData;
    }
}

