<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

/**
 * Controller نحيف لتسجيل المستخدمين: بينادي RegisterUserAction.
 */
class RegisterController extends Controller
{
    public function register(CreateUserRequest $request, RegisterUserAction $action): JsonResponse
    {
        $result = $action->execute($request->validated());

        return response()->json([
            'user'         => new UserResource($result['user']),
            'access_token' => $result['token'],
            'token_type'   => 'Bearer',
        ], 201);
    }
}
