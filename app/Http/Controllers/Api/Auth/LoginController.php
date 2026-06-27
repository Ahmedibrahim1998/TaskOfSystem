<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller نحيف لتسجيل الدخول والخروج: بينادي Actions.
 */
class LoginController extends Controller
{
    public function login(LoginUserRequest $request, LoginUserAction $action): JsonResponse
    {
        $validated = $request->validated();

        $result = $action->execute($validated['email'], $validated['password']);

        return response()->json([
            'message'      => 'تم تسجيل الدخول بنجاح',
            'user'         => new UserResource($result['user']),
            'access_token' => $result['token'],
            'token_type'   => 'Bearer',
        ]);
    }

    public function logout(Request $request, LogoutUserAction $action): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $action->execute($user);

        return response()->json([
            'message' => 'تم تسجيل الخروج بنجاح',
        ]);
    }
}
