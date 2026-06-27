<?php

namespace App\Domain\Comment\Entities;

use App\Domain\User\Entities\UserEntity;

/**
 * كيان (Entity) التعليق في طبقة الـ Domain — PHP خالص بدون اعتماد على Laravel.
 */
final class CommentEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $userId,
        public readonly int $postId,
        public readonly string $body,
        public readonly ?UserEntity $user = null,
        public readonly ?\DateTimeImmutable $createdAt = null,
        public readonly ?\DateTimeImmutable $updatedAt = null,
    ) {
    }
}
