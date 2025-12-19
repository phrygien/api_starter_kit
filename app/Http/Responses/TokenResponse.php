<?php

declare(strict_types = 1);

namespace App\Http\Responses;

use App\Http\Factories\HeaderFactory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class TokenResponse implements Responsable
{
    public function __construct(#[\SensitiveParameter] private readonly string $token, private readonly int $status = Response::HTTP_OK) {}

    public function toResponse($request): Response
    {
        return new JsonResponse(
            data: [
                'token' => $this->token,
                'type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60
            ],
            status: $this->status,
            headers: HeaderFactory::default()
        );
    }
}