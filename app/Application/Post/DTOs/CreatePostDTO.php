<?php

namespace App\Application\Post\DTOs;

/**
 * Data Transfer Object لإنشاء منشور — بينقل المدخلات النضيفة من طبقة الـ Http
 * لطبقة Application من غير ما الـ Use Case يعرف حاجة عن الـ Request.
 */
final class CreatePostDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $title,
        public readonly string $slug,
        public readonly string $content,
    ) {
    }
}
