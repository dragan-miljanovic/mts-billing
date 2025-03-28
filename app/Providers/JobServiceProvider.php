<?php

namespace App\Providers;

use App\Repositories\CallChargeRepository;
use App\Repositories\ConfirmationRepository;
use App\Repositories\Contracts\CallChargeRepositoryInterface;
use App\Repositories\Contracts\ConfirmationRepositoryInterface;
use App\Repositories\Contracts\ImportLogRepositoryInterface;
use App\Repositories\ImportLogRepository;
use App\Services\Import\CallChargeMapperService;
use App\Services\Import\ConfirmationMapperService;
use App\Services\Import\Contracts\CallChargeMapperInterface;
use App\Services\Import\Contracts\ConfirmationMapperInterface;
use Illuminate\Support\ServiceProvider;

class JobServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ConfirmationMapperInterface::class, ConfirmationMapperService::class);
        $this->app->bind(CallChargeMapperInterface::class, CallChargeMapperService::class);
        $this->app->bind(CallChargeRepositoryInterface::class, CallChargeRepository::class);
        $this->app->bind(ConfirmationRepositoryInterface::class, ConfirmationRepository::class);
        $this->app->bind(ImportLogRepositoryInterface::class, ImportLogRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
