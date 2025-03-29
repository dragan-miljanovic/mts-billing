<?php

namespace App\Providers;

use App\Repositories\Contracts\ImportLogRepositoryInterface;
use App\Repositories\ImportLogRepository;
use App\Services\Import\Contracts\FileReaderInterface;
use App\Services\Import\Contracts\ImportFactoryInterface;
use App\Services\Import\Contracts\ImportServiceInterface;
use App\Services\Import\Factories\ImportFactory;
use App\Services\Import\ImportService;
use App\Services\Import\Readers\TextFileReader;
use App\Utils\Contracts\LoggerInterface;
use App\Utils\LogHelper;
use Illuminate\Support\ServiceProvider;

class ImportServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoggerInterface::class, LogHelper::class);
        $this->app->bind(FileReaderInterface::class, TextFileReader::class);
        $this->app->bind(ImportLogRepositoryInterface::class, ImportLogRepository::class);
        $this->app->bind(ImportServiceInterface::class, ImportService::class);

        $this->app->bind(ImportFactoryInterface::class, function ($app) {
            return new ImportFactory(
                $app->make(LoggerInterface::class),
                $app->make(ImportLogRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
