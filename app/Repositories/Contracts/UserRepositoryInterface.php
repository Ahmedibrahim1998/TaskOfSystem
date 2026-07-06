<?php

namespace App\Repositories\Contracts;

use App\Models\User;

/**
 * عقد مستودع المستخدمين.
 */
interface UserRepositoryInterface
{
    /**
     * ينشئ مستخدم جديد.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): User;

    /**
     * يرجّع مستخدم بالبريد الإلكتروني، أو null لو مش موجود.
     */
    public function findByEmail(string $email): ?User;
}
