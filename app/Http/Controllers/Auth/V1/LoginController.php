<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth\V1;

use App\Http\Requests\Auth\V1\LoginRequest;
use Illuminate\Http\JsonResponse;
use Mecene\Modules\Identity\Contract;
use Symfony\Component\HttpFoundation\Response;

final readonly class LoginController
{
    /**
     * Summary of __construct
     * @param Contract $identity
     */
    public function __construct(private readonly Contract $identity){}

    /**
     * Summary of __invoke
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): Response
    {
        $result = $this->identity->attempt(
            payload: $request->payload()
        );

        if($result->isError()) {
            throw $result->error;
        }

        return new JsonResponse(
            data: [
                'token' => $result->value,
                'type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60
            ]
        );
    }
}