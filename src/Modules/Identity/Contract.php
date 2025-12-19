<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity;

use Mecene\Modules\Identity\DTOs\LoginObject;
use Mecene\Modules\Identity\DTOs\RegistrationObject;
use Mecene\Support\Result;

interface Contract
{
    public function attempt(LoginObject $payload): Result;

    public function register(RegistrationObject $payload): Result;
}