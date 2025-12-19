<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Database\DatabaseManager;
use Mecene\Modules\Identity\Contract;
use Mecene\Modules\Identity\DTOs\LoginObject;
use Mecene\Modules\Identity\DTOs\RegistrationObject;
use Mecene\Support\Result;

final readonly class IdentityService implements Contract
{

    /**
     * Summary of __construct
     * @param Factory $auth
     * @param DatabaseManager $database
     */
    public function __construct(private Factory $auth, private DatabaseManager $database)
    {
        
    }

    /**
     * Summary of attempt
     * @param LoginObject $payload
     * @return Result
     */
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

    /**
     * Summary of register
     * @param RegistrationObject $payload
     * @return Result
     */
    public function register(RegistrationObject $payload): Result
    {
        $user = $this->database->transaction(
            callback: fn() => User::query()->create($payload->toArray()),
            attempts: 3
        );

        if(!$user)
        {
            return Result::error(
             error: new \RuntimeException(
                message: "Failed to create user registration"
             ),
            );
        }

        $token = $this->auth->guard('api')->attempt(
            credentials: $payload->toArray()
        );

        if(!$token)
        {
            return Result::error(
                error: new AuthenticationException(message: 'Failed to authenticate')
            );
        }

        return Result::ok(value: [
            'token' => $token,
            'users'=> $user
        ]);
    }
}