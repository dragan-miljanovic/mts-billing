<?php

namespace App\Providers;

use App\Services\Confirmation\ConfirmationCrudService;
use App\Services\Confirmation\Contracts\ConfirmationCrudServiceInterface;
use Illuminate\Support\ServiceProvider;

class ConfirmationSeviceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ConfirmationCrudServiceInterface::class, ConfirmationCrudService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
