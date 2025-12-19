<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity;

use Illuminate\Support\ServiceProvider;
use Mecene\Modules\Identity\Services\IdentityService;

final class IdentityServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(
            abstract: Contract::class,
            concrete: IdentityService::class,
        );
    }

}