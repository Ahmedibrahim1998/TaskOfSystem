<?php

namespace App\Application\Comment\DTOs;

/**
 * DTO لإنشاء تعليق.
 */
final class CreateCommentDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly int $postId,
        public readonly string $body,
    ) {
    }
}
