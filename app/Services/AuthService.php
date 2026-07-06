<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * طبقة منطق العمل للمصادقة (تسجيل/دخول/خروج).
 *
 * في نمط Service + Repository عادي إن الـ Service يستخدم أدوات Laravel مباشرة
 * (Hash، التوكِنات) — النمط ده مايهدفش لعزل الإطار زي Clean Architecture.
 */
class AuthService
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {
    }

    /**
     * يسجّل مستخدم جديد ويصدر له توكِن.
     *
     * @param  array<string, mixed>  $data
     * @return array{user: User, token: string}
     */
    public function register(array $data): array
    {
        $user = $this->users->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'user'  => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];
    }

    /**
     * يتحقق من بيانات الدخول ويصدر توكِن، أو يرمي ValidationException.
     *
     * @return array{user: User, token: string}
     *
     * @throws ValidationException
     */
    public function login(string $email, string $password): array
    {
        $user = $this->users->findByEmail($email);

        if ($user === null || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return [
            'user'  => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];
    }

    /**
     * يسجّل خروج المستخدم بإلغاء التوكِن الحالي.
     */
    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
