<?php

namespace App\Http\Controllers\Api\Auth;

use App\Application\Auth\DTOs\RegisterDTO;
use App\Application\Auth\UseCases\RegisterUserUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

/**
 * Controller نحيف لتسجيل المستخدمين (طبقة Presentation).
 */
class RegisterController extends Controller
{
    public function register(CreateUserRequest $request, RegisterUserUseCase $registerUser): JsonResponse
    {
        $validated = $request->validated();

        $result = $registerUser->execute(new RegisterDTO(
            name: $validated['name'],
            email: $validated['email'],
            password: $validated['password'],
        ));

        return response()->json([
            'user'         => new UserResource($result->user),
            'access_token' => $result->accessToken,
            'token_type'   => $result->tokenType,
        ], 201);
    }
}
