<?php

namespace App\Utils\Contracts;

interface LoggerInterface
{
    /**
     * Log an emergency message
     *
     * @param string $message
     * @param array $context
     */
    public function emergency(string $message, array $context = []): void;

    /**
     * Log an alert message
     *
     * @param string $message
     * @param array $context
     */
    public function alert(string $message, array $context = []): void;

    /**
     * Log a critical message
     *
     * @param string $message
     * @param array $context
     */
    public function critical(string $message, array $context = []): void;

    /**
     * Log an error message
     *
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = []): void;

    /**
     * Log a warning message
     *
     * @param string $message
     * @param array $context
     */
    public function warning(string $message, array $context = []): void;

    /**
     * Log an informational message
     *
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = []): void;

    /**
     * Log a debug message
     *
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = []): void;
}
