<?php

namespace App\Providers;

use App\Services\CallCharge\CallChargeCrudService;
use App\Services\CallCharge\Contracts\CallChargeCrudServiceInterface;
use Illuminate\Support\ServiceProvider;

class CallChargeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CallChargeCrudServiceInterface::class, CallChargeCrudService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
