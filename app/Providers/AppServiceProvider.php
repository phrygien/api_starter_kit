<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Mecene\Modules\Identity\IdentityServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict();

        $this->registerModules();
    }

    /**
     * Summary of registerModules
     * @return void
     */
    public function registerModules(): void
    {
        $this->app->register(
            provider: IdentityServiceProvider::class
        );
    }
}
