<?php

namespace App\Domain\Post\Exceptions;

/**
 * استثناء على مستوى الـ Domain يُرمى لمّا منشور مطلوب مش موجود.
 *
 * بيفضل نقي بدون أي اعتماد على HTTP/Laravel — طبقة الـ Presentation هي اللي
 * بتترجمه لاستجابة 404 (راجع bootstrap/app.php).
 */
final class PostNotFoundException extends \RuntimeException
{
    public static function withId(int $id): self
    {
        return new self("لا يوجد منشور بالمعرّف {$id}");
    }
}
