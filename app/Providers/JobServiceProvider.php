<?php

namespace App\Providers;

use App\Jobs\CallChargeImport;
use App\Jobs\ConfImport;
use App\Repositories\CallChargeRepository;
use App\Repositories\ConfirmationRepository;
use App\Repositories\Contracts\CallChargeRepositoryInterface;
use App\Repositories\Contracts\ConfirmationRepositoryInterface;
use App\Repositories\Contracts\ImportLogRepositoryInterface;
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

        $this->app->bindMethod([CallChargeImport::class, 'handle'], function ($job, $app) {
            return $job->handle(
                $app->make(ImportLogRepositoryInterface::class),
                $app->make(CallChargeRepositoryInterface::class),
                $app->make(CallChargeMapperInterface::class),
            );
        });

        $this->app->bindMethod([ConfImport::class, 'handle'], function ($job, $app) {
            return $job->handle(
                $app->make(ImportLogRepositoryInterface::class),
                $app->make(ConfirmationRepositoryInterface::class),  // Correct interface
                $app->make(ConfirmationMapperInterface::class),
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
