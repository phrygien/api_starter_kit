<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory;
use Mecene\Modules\Identity\Contract;
use Mecene\Modules\Identity\DTOs\LoginObject;
use Mecene\Support\Result;


final readonly class IdentityService implements Contract
{

    public function __construct(private Factory $auth)
    {
        
    }

    public function attempt(LoginObject $payload): Result
    {
        $token = $this->auth->guard('api')->attempt(
            credentials: $payload->toArray()
        );

        if( !$token)
        {
            return Result::error(
                error: new AuthenticationException(
                    message: 'Invalide credentials provided'
                )
            );
        }

        return Result::ok(
            value: $token,
        );
    }
}