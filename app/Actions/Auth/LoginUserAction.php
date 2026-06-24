<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Action: التحقق من بيانات الدخول وإصدار توكِن.
 */
class LoginUserAction
{
    /**
     * @return array{user: User, token: string}
     *
     * @throws ValidationException
     */
    public function execute(string $email, string $password): array
    {
        if (! Auth::attempt(['email' => $email, 'password' => $password])) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        /** @var User $user */
        $user = User::query()->where('email', $email)->firstOrFail();

        return [
            'user'  => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];
    }
}
