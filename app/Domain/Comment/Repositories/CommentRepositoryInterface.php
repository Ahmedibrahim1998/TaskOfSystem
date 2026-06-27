<?php

namespace App\Domain\Comment\Repositories;

use App\Domain\Comment\Entities\CommentEntity;
use App\Domain\Shared\PaginatedResult;

/**
 * عقد (Contract) مستودع التعليقات — معرّف في طبقة الـ Domain.
 */
interface CommentRepositoryInterface
{
    /**
     * يرجّع تعليقات منشور معيّن مقسّمة لصفحات.
     *
     * @return PaginatedResult<CommentEntity>
     */
    public function paginateByPost(int $postId, int $perPage): PaginatedResult;

    /**
     * ينشئ تعليق جديد ويرجّع الكيان بعد الحفظ (مع الكاتب).
     */
    public function create(CommentEntity $comment): CommentEntity;
}
