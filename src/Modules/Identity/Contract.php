<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity;

use Mecene\Modules\Identity\DTOs\LoginObject;
use Mecene\Modules\Identity\DTOs\RegistrationObject;
use Mecene\Support\Result;

interface Contract
{
    /**
     * Summary of attempt
     * @param LoginObject $payload
     * @return void
     */
    public function attempt(LoginObject $payload): Result;

    /**
     * Summary of register
     * @param RegistrationObject $payload
     * @return void
     */
    public function register(RegistrationObject $payload): Result;

    /**
     * Summary of user
     * @return void
     */
    public function user(): Result;
}