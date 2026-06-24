<?php

namespace App\Http\Controllers\Api\Auth;

use App\Application\Auth\DTOs\LoginDTO;
use App\Application\Auth\UseCases\LoginUserUseCase;
use App\Application\Auth\UseCases\LogoutUserUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

/**
 * Controller نحيف لتسجيل الدخول والخروج (طبقة Presentation).
 */
class LoginController extends Controller
{
    public function login(LoginUserRequest $request, LoginUserUseCase $loginUser): JsonResponse
    {
        $validated = $request->validated();

        $result = $loginUser->execute(new LoginDTO(
            email: $validated['email'],
            password: $validated['password'],
        ));

        return response()->json([
            'message'      => 'تم تسجيل الدخول بنجاح',
            'user'         => new UserResource($result->user),
            'access_token' => $result->accessToken,
            'token_type'   => $result->tokenType,
        ]);
    }

    public function logout(LogoutUserUseCase $logoutUser): JsonResponse
    {
        $logoutUser->execute();

        return response()->json([
            'message' => 'تم تسجيل الخروج بنجاح',
        ]);
    }
}
