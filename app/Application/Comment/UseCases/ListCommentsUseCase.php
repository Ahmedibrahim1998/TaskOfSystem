<?php

namespace App\Application\Comment\UseCases;

use App\Domain\Comment\Entities\CommentEntity;
use App\Domain\Comment\Repositories\CommentRepositoryInterface;
use App\Domain\Shared\PaginatedResult;

/**
 * Use Case: عرض تعليقات منشور معيّن مقسّمة لصفحات.
 */
final class ListCommentsUseCase
{
    public function __construct(
        private readonly CommentRepositoryInterface $comments,
    ) {
    }

    /**
     * @return PaginatedResult<CommentEntity>
     */
    public function execute(int $postId, int $perPage = 10): PaginatedResult
    {
        return $this->comments->paginateByPost($postId, $perPage);
    }
}
