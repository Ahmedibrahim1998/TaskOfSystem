<?php

namespace App\Application\Auth\UseCases;

use App\Domain\Auth\Services\TokenIssuerInterface;

/**
 * Use Case: تسجيل الخروج بإلغاء التوكِن الحالي.
 */
final class LogoutUserUseCase
{
    public function __construct(
        private readonly TokenIssuerInterface $tokens,
    ) {
    }

    public function execute(): void
    {
        $this->tokens->revokeCurrent();
    }
}
