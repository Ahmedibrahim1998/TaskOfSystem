<?php

namespace App\Application\Comment\UseCases;

use App\Application\Comment\DTOs\CreateCommentDTO;
use App\Domain\Comment\Entities\CommentEntity;
use App\Domain\Comment\Repositories\CommentRepositoryInterface;

/**
 * Use Case: إضافة تعليق جديد على منشور.
 */
final class CreateCommentUseCase
{
    public function __construct(
        private readonly CommentRepositoryInterface $comments,
    ) {
    }

    public function execute(CreateCommentDTO $dto): CommentEntity
    {
        $comment = new CommentEntity(
            id: null,
            userId: $dto->userId,
            postId: $dto->postId,
            body: $dto->body,
        );

        return $this->comments->create($comment);
    }
}
