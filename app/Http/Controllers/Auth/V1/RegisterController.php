<?php

namespace App\Http\Controllers\Auth\V1;

use App\Http\Requests\Auth\V1\RegistrationRequest;
use App\Http\Responses\TokenResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Mecene\Modules\Identity\Contract;
use Symfony\Component\HttpFoundation\Response;

class RegisterController
{
    /**
     * Summary of __construct
     * @param Contract $identity
     */
    public function __construct(private Contract $identity){}

    /**
     * Summary of __invoke
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegistrationRequest $request): Responsable
    {
        $result = $this->identity->register(
            payload: $request->payload()
        );

        if($result->isError())
        {
            throw $result->error;
        }

        return new TokenResponse(
            token: $result->value,
            status: Response::HTTP_CREATED
        );
    }
}
