<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Document\DocumentRepositoryInterface::class,
            \App\Repositories\Document\DocumentEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Exemption\ExemptionRepositoryInterface::class,
            \App\Repositories\Exemption\ExemptionEloquentRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
