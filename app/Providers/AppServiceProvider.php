<?php

namespace App\Providers;

use App\Clients;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        JsonResource::withoutWrapping();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\Client',
            'App\Services\Clients\TripAdvisor'
        );

        $this->app->singleton(Clients\TripAdvisor::class, function ($app) {
            new Clients\TripAdvisor();
        });
    }
}
