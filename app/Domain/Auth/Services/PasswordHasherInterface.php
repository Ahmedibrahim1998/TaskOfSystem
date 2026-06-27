<?php

namespace App\Domain\Auth\Services;

/**
 * عقد تجزئة كلمات المرور — مجرّد عن أي مكتبة. التنفيذ (Bcrypt عبر Laravel)
 * موجود في طبقة Infrastructure. كده الـ Domain مايعرفش حاجة عن آلية التجزئة.
 */
interface PasswordHasherInterface
{
    public function hash(string $plain): string;

    public function check(string $plain, string $hashed): bool;
}
