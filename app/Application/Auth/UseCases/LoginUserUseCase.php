<?php

namespace App\Application\Auth\UseCases;

use App\Application\Auth\DTOs\LoginDTO;
use App\Application\Auth\Results\AuthResult;
use App\Domain\Auth\Exceptions\InvalidCredentialsException;
use App\Domain\Auth\Services\PasswordHasherInterface;
use App\Domain\Auth\Services\TokenIssuerInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;

/**
 * Use Case: تسجيل الدخول والتحقق من البيانات وإصدار توكِن.
 */
final class LoginUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly PasswordHasherInterface $hasher,
        private readonly TokenIssuerInterface $tokens,
    ) {
    }

    public function execute(LoginDTO $dto): AuthResult
    {
        $hashedPassword = $this->users->getHashedPasswordByEmail($dto->email);

        if ($hashedPassword === null || ! $this->hasher->check($dto->password, $hashedPassword)) {
            throw InvalidCredentialsException::make();
        }

        $user = $this->users->findByEmail($dto->email);

        if ($user === null) {
            throw InvalidCredentialsException::make();
        }

        $token = $this->tokens->issueFor((int) $user->id, 'auth_token');

        return new AuthResult($user, $token);
    }
}
