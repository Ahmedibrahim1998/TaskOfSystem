<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\UserEntity;

/**
 * عقد مستودع المستخدمين — معرّف في طبقة الـ Domain.
 */
interface UserRepositoryInterface
{
    /**
     * يرجّع مستخدم بالبريد الإلكتروني، أو null لو مش موجود.
     */
    public function findByEmail(string $email): ?UserEntity;

    /**
     * يرجّع كلمة المرور المجزَّأة (hashed) المخزّنة لبريد معيّن — للتحقق عند الدخول.
     * بترجع null لو المستخدم مش موجود. ملاحظة: الـ hash مايتسربش لكيان الـ Domain أبدًا.
     */
    public function getHashedPasswordByEmail(string $email): ?string;

    /**
     * ينشئ مستخدم جديد بكلمة مرور مجزَّأة مسبقًا، ويرجّع كيانه.
     */
    public function create(string $name, string $email, string $hashedPassword): UserEntity;
}
