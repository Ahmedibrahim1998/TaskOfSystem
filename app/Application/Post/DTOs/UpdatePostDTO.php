<?php

namespace App\Application\Post\DTOs;

/**
 * DTO لتعديل منشور — كل الحقول اختيارية (nullable) لدعم التعديل الجزئي،
 * زي قواعد "sometimes" في UpdatePostRequest.
 */
final class UpdatePostDTO
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $slug = null,
        public readonly ?string $content = null,
    ) {
    }
}
