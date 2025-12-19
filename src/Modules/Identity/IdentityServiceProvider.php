<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity;

use Illuminate\Support\ServiceProvider;
use Mecene\Modules\Identity\Services\IdentityService;

final class IdentityServiceProvider extends ServiceProvider
{

    /**
     * Summary of register
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: Contract::class,
            concrete: IdentityService::class,
        );
    }

}