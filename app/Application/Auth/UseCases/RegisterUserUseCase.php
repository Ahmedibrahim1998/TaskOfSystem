<?php

namespace App\Application\Auth\UseCases;

use App\Application\Auth\DTOs\RegisterDTO;
use App\Application\Auth\Results\AuthResult;
use App\Domain\Auth\Services\PasswordHasherInterface;
use App\Domain\Auth\Services\TokenIssuerInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;

/**
 * Use Case: تسجيل مستخدم جديد وإصدار توكِن وصول.
 *
 * بيتعامل مع 3 عقود مجرّدة بس (مستودع، تجزئة، إصدار توكِن) — صفر اعتماد مباشر على Laravel.
 */
final class RegisterUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly PasswordHasherInterface $hasher,
        private readonly TokenIssuerInterface $tokens,
    ) {
    }

    public function execute(RegisterDTO $dto): AuthResult
    {
        $user = $this->users->create(
            name: $dto->name,
            email: $dto->email,
            hashedPassword: $this->hasher->hash($dto->password),
        );

        $token = $this->tokens->issueFor((int) $user->id, 'auth_token');

        return new AuthResult($user, $token);
    }
}
