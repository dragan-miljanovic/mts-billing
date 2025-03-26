<?php

namespace App\Utils;

use App\Utils\Contracts\LoggerInterface;
use Illuminate\Support\Facades\Log;

class LogHelper implements LoggerInterface
{
    /**
     * Emergency level log
     *
     * @param string $message
     * @param array $context
     */
    public function emergency(string $message, array $context = []): void
    {
        Log::emergency($message, $context);
    }

    /**
     * Alert level log
     *
     * @param string $message
     * @param array $context
     */
    public function alert(string $message, array $context = []): void
    {
        Log::alert($message, $context);
    }

    /**
     * Critical level log
     *
     * @param string $message
     * @param array $context
     */
    public function critical(string $message, array $context = []): void
    {
        Log::critical($message, $context);
    }

    /**
     * Error level log
     *
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = []): void
    {
        Log::error($message, $context);
    }

    /**
     * Warning level log
     *
     * @param string $message
     * @param array $context
     */
    public function warning(string $message, array $context = []): void
    {
        Log::warning($message, $context);
    }

    /**
     * Info level log
     *
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }

    /**
     * Debug level log
     *
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = []): void
    {
        Log::debug($message, $context);
    }
}
