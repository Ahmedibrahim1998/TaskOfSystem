<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Post\Entities\PostEntity;
use App\Models\Post;

/**
 * Mapper بيحوّل موديل Eloquent (Post) لكيان Domain (PostEntity) مع علاقاته.
 */
final class PostMapper
{
    public function __construct(
        private readonly UserMapper $userMapper = new UserMapper(),
        private readonly CommentMapper $commentMapper = new CommentMapper(),
    ) {
    }

    public function toEntity(Post $model): PostEntity
    {
        return new PostEntity(
            id: $model->id,
            userId: $model->user_id,
            title: $model->title,
            slug: $model->slug,
            content: $model->content,
            user: $model->relationLoaded('user') && $model->user !== null
                ? $this->userMapper->toEntity($model->user)
                : null,
            comments: $model->relationLoaded('comments')
                ? $model->comments->map(
                    fn (\App\Models\Comment $comment) => $this->commentMapper->toEntity($comment)
                )->all()
                : [],
            createdAt: $model->created_at !== null
                ? \DateTimeImmutable::createFromInterface($model->created_at)
                : null,
            updatedAt: $model->updated_at !== null
                ? \DateTimeImmutable::createFromInterface($model->updated_at)
                : null,
        );
    }
}
