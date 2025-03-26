<?php

namespace App\Services\Import\Contracts;

use App\Services\Import\Strategies\CdrImportStrategy;
use App\Services\Import\Strategies\ConfImportStrategy;

interface ImportFactoryInterface
{
    public function createImportStrategy(string $type): CdrImportStrategy|ConfImportStrategy;
}
