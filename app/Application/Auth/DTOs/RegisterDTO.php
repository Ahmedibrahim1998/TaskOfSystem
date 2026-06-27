<?php

namespace App\Application\Auth\DTOs;

/**
 * DTO لتسجيل مستخدم جديد. الـ password هنا نصّي صريح؛ التجزئة بتحصل في الـ Use Case.
 */
final class RegisterDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
