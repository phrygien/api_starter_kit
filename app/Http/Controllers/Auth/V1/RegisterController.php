<?php

namespace App\Http\Controllers\Auth\V1;

use App\Http\Requests\Auth\V1\RegistrationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mecene\Modules\Identity\Contract;

class RegisterController
{
    /**
     * Summary of __construct
     * @param Contract $identity
     */
    public function __construct(private readonly Contract $identity){}

    /**
     * Summary of __invoke
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegistrationRequest $request)
    {
        $result = $this->identity->register(
            payload: $request->payload()
        );

        if($result->isError())
        {
            throw $result->error;
        }

        return new JsonResponse(data: [
            'token' => $result->value
        ]);
    }
}
