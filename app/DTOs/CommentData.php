<?php

namespace App\DTOs;

/**
 * كائن نقل بيانات (DTO) لإنشاء تعليق.
 *
 * بيغلّف بيانات التعليق في نوع صريح بدل تمرير قيم مبعثرة (string/array)
 * للـ Service، فيمنع الأخطاء ويوضّح ما تحتاجه العملية.
 */
final class CommentData
{
    public function __construct(
        public readonly string $body,
    ) {
    }

    /**
     * ينشئ الـ DTO من مصفوفة بيانات مُتحقَّق منها.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            body: (string) $data['body'],
        );
    }
}
