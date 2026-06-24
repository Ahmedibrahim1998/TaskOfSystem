<?php

namespace App\Infrastructure\Auth;

use App\Domain\Auth\Services\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

/**
 * تنفيذ تجزئة كلمات المرور باستخدام Hashing بتاع Laravel — طبقة Infrastructure.
 */
final class BcryptPasswordHasher implements PasswordHasherInterface
{
    public function hash(string $plain): string
    {
        return Hash::make($plain);
    }

    public function check(string $plain, string $hashed): bool
    {
        return Hash::check($plain, $hashed);
    }
}
