<?php

namespace App\Application\Auth\Results;

use App\Domain\User\Entities\UserEntity;

/**
 * نتيجة عملية مصادقة ناجحة (تسجيل/دخول): المستخدم + توكِن الوصول.
 */
final class AuthResult
{
    public function __construct(
        public readonly UserEntity $user,
        public readonly string $accessToken,
        public readonly string $tokenType = 'Bearer',
    ) {
    }
}
