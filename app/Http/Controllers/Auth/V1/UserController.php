<?php

namespace App\Http\Controllers\Auth\V1;

use App\Http\Resources\V1\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mecene\Modules\Identity\Contract;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    /**
     * Summary of __construct
     * @param Contract $identity
     */
    public function __construct(
        private Contract $identity
    ){}

    /**
     * Summary of __invoke
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): Response
    {
        $user = $this->identity->user(); 

        if($user->isError())
        {
            throw $user->error;
        }

        return new JsonResponse(data: new UserResource($user->value), status: Response::HTTP_OK);
    }
}
