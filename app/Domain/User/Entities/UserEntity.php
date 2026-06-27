<?php

namespace App\Domain\User\Entities;

/**
 * كيان (Entity) المستخدم في طبقة الـ Domain — PHP خالص بدون أي اعتماد على Laravel.
 *
 * ملاحظة: ده مختلف عن App\Models\User (موديل Eloquent). الموديل تفصيلة في
 * طبقة Infrastructure، والكيان ده هو التمثيل النقي للمستخدم داخل منطق العمل.
 */
final class UserEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?\DateTimeImmutable $createdAt = null,
    ) {
    }
}
