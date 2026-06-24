<?php

namespace App\Domain\Auth\Services;

/**
 * عقد إصدار/إلغاء توكِنات الوصول — مجرّد عن Sanctum. التنفيذ في طبقة Infrastructure.
 */
interface TokenIssuerInterface
{
    /**
     * يصدر توكِن وصول نصّي لمستخدم بالمعرّف المعطى.
     */
    public function issueFor(int $userId, string $tokenName): string;

    /**
     * يلغي توكِن الوصول الحالي للمستخدم المسجَّل دخوله (تسجيل خروج).
     */
    public function revokeCurrent(): void;
}
