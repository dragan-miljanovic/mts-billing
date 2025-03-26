<?php

namespace App\Services\Import\Contracts;

interface ImportStrategyInterface
{
    /**
     * Process imported data
     *
     * @param array $data
     */
    public function process(array $data): void;
}
