<?php

namespace App\Services\Import\Contracts;

interface ImportServiceInterface
{
    public function import(string $file): void;
}
