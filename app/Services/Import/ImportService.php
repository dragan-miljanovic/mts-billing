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

        // Import the processed data
        $this->importFactory->createImportStrategy($cdrType)->process($data[$cdrType]);
        $this->importFactory->createImportStrategy($confType)->process($data[$confType]);
    }
}

