<?php

namespace App\Application\Auth\DTOs;

/**
 * DTO لتسجيل الدخول.
 */
final class LoginDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
