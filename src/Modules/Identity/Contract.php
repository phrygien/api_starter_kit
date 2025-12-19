<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity;

use Mecene\Modules\Identity\DTOs\LoginObject;
use Mecene\Support\Result;

interface Contract
{
    public function attempt(LoginObject $payload): Result;
}