<?php

namespace App\Infrastructure\Auth;

use App\Domain\Auth\Services\TokenIssuerInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * تنفيذ إصدار/إلغاء التوكِنات باستخدام Laravel Sanctum — طبقة Infrastructure.
 *
 * ده المكان الوحيد اللي بيعرف إن المصادقة بتتم عن طريق Sanctum؛ لو غيّرنا آلية
 * المصادقة (JWT مثلاً) بنغيّر الكلاس ده بس من غير ما نلمس Application أو Domain.
 */
final class SanctumTokenIssuer implements TokenIssuerInterface
{
    public function issueFor(int $userId, string $tokenName): string
    {
        $user = User::query()->findOrFail($userId);

        return $user->createToken($tokenName)->plainTextToken;
    }

    public function revokeCurrent(): void
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return;
        }

        // التوكِن الحالي الجاي مع الطلب (Sanctum) — بنلغيه لتسجيل الخروج.
        $user->currentAccessToken()->delete();
    }
}
