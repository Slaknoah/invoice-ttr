<?php

namespace App\Providers;

use App\Clients;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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

        Builder::macro( 'whereLike', function ($attributes, string $searchTerm ) {
            $this->where( function ( Builder $query ) use ( $attributes, $searchTerm ) {
                foreach ( Arr::wrap( $attributes ) as $attribute ) {
                    $query->when(
                        Str::contains( $attribute, '.' ),
                        function ( Builder $query ) use ( $attribute, $searchTerm ) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });
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
