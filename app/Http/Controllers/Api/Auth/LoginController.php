<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

/**
 * Controller نحيف لتسجيل الدخول والخروج: بينادي AuthService.
 */
class LoginController extends Controller
{
    public function __construct(
        private readonly AuthService $auth,
    ) {
    }

    public function login(LoginUserRequest $request): ApiResponse
    {
        $validated = $request->validated();

        $result = $this->auth->login($validated['email'], $validated['password']);

        return new ApiResponse('تم تسجيل الدخول بنجاح', [
            'user'         => new UserResource($result['user']),
            'access_token' => $result['token'],
            'token_type'   => 'Bearer',
        ]);
    }

    public function logout(Request $request): ApiResponse
    {
        /** @var User $user */
        $user = $request->user();

        $this->auth->logout($user);

        return ApiResponse::success('تم تسجيل الخروج بنجاح');
    }
}
