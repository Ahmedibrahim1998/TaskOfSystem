<?php

namespace App\Domain\Auth\Exceptions;

/**
 * استثناء Domain يُرمى لمّا بيانات الدخول غلط — تُترجم لـ 422 في طبقة الـ Presentation.
 */
final class InvalidCredentialsException extends \RuntimeException
{
    public static function make(): self
    {
        return new self('بيانات الدخول غير صحيحة');
    }
}
