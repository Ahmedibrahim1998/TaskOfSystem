<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Comment\Entities\CommentEntity;
use App\Models\Comment;

/**
 * Mapper بيحوّل موديل Eloquent (Comment) لكيان Domain (CommentEntity).
 */
final class CommentMapper
{
    public function __construct(
        private readonly UserMapper $userMapper = new UserMapper(),
    ) {
    }

    public function toEntity(Comment $model): CommentEntity
    {
        return new CommentEntity(
            id: $model->id,
            userId: $model->user_id,
            postId: $model->post_id,
            body: $model->body,
            user: $model->relationLoaded('user') && $model->user !== null
                ? $this->userMapper->toEntity($model->user)
                : null,
            createdAt: $model->created_at !== null
                ? \DateTimeImmutable::createFromInterface($model->created_at)
                : null,
            updatedAt: $model->updated_at !== null
                ? \DateTimeImmutable::createFromInterface($model->updated_at)
                : null,
        );
    }
}
