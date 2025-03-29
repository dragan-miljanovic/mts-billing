<?php

namespace App\Services\Import\Readers;

use App\Services\Import\Contracts\FileReaderInterface;
use App\Services\Import\Enums\ImportTypeEnum;
use RuntimeException;

class TextFileReader implements FileReaderInterface
{
    /**
     * Read file content
     *
     * @param string $file
     * @return array|array[]
     * @throws RuntimeException
     */
    public function read(string $file): array
    {
        if (!file_exists($file)) {
            throw new RuntimeException("File not found: $file");
        }

        $data = file_get_contents($file);
        if ($data === false) {
            throw new RuntimeException("Error reading file: $file");
        }

        return $this->parseData($data);
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

        foreach ($records as $index => $line) {
            if (str_contains($line, '#CRCE CDR')) {
                $currentCategory = $cdrType;
            } elseif (str_contains($line, '#CRCE CONF')) {
                $currentCategory = $confType;
            } elseif ($currentCategory && !empty(trim($line))) {
                $parsedData[$currentCategory][$index]['data'] = array_slice(explode('|', $line), 23);
                $parsedData[$currentCategory][$index]['headers'] = array_slice(explode('|', $line), 0, 23);
            }
        }

        return $parsedData;
    }
}
