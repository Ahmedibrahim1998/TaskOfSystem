<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use App\Services\AuthService;

/**
 * Controller نحيف لتسجيل المستخدمين: بينادي AuthService.
 */
class RegisterController extends Controller
{
    public function __construct(
        private readonly AuthService $auth,
    ) {
    }

    public function register(CreateUserRequest $request): ApiResponse
    {
        $result = $this->auth->register($request->validated());

        return new ApiResponse(payload: [
            'user'         => new UserResource($result['user']),
            'access_token' => $result['token'],
            'token_type'   => 'Bearer',
        ], status: 201);
    }
}
