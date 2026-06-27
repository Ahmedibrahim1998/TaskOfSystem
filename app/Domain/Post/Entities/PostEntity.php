<?php

namespace App\Domain\Post\Entities;

use App\Domain\Comment\Entities\CommentEntity;
use App\Domain\User\Entities\UserEntity;

/**
 * كيان (Entity) المنشور في طبقة الـ Domain — PHP خالص بدون اعتماد على Laravel.
 *
 * الكيان ده هو قلب منطق العمل: بيحمل بيانات المنشور وعلاقاته (الكاتب والتعليقات)
 * كـ كيانات Domain تانية، مش كموديلات Eloquent.
 */
final class PostEntity
{
    /**
     * @param  list<CommentEntity>  $comments
     */
    public function __construct(
        public readonly ?int $id,
        public readonly int $userId,
        public readonly string $title,
        public readonly string $slug,
        public readonly string $content,
        public readonly ?UserEntity $user = null,
        public readonly array $comments = [],
        public readonly ?\DateTimeImmutable $createdAt = null,
        public readonly ?\DateTimeImmutable $updatedAt = null,
    ) {
    }

    /**
     * يرجّع نسخة جديدة من الكيان بعد دمج التعديلات المسموح بيها.
     * بيُستخدم في حالة التعديل الجزئي (PATCH/PUT) للحفاظ على عدم قابلية التغيير (immutability).
     */
    public function withChanges(?string $title, ?string $slug, ?string $content): self
    {
        return new self(
            id: $this->id,
            userId: $this->userId,
            title: $title ?? $this->title,
            slug: $slug ?? $this->slug,
            content: $content ?? $this->content,
            user: $this->user,
            comments: $this->comments,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
