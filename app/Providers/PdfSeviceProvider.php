<?php

namespace App\Providers;

use App\Services\Pdf\Contracts\GeneratePdfServiceInterface;
use App\Services\Pdf\GeneratePdfService;
use Illuminate\Support\ServiceProvider;

class PdfSeviceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GeneratePdfServiceInterface::class, GeneratePdfService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
