<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Comment\Entities\CommentEntity;
use App\Domain\Comment\Repositories\CommentRepositoryInterface;
use App\Domain\Shared\PaginatedResult;
use App\Infrastructure\Persistence\Eloquent\Mappers\CommentMapper;
use App\Models\Comment;

/**
 * تنفيذ مستودع التعليقات باستخدام Eloquent — طبقة Infrastructure.
 */
final class EloquentCommentRepository implements CommentRepositoryInterface
{
    public function __construct(
        private readonly CommentMapper $mapper = new CommentMapper(),
    ) {
    }

    public function paginateByPost(int $postId, int $perPage): PaginatedResult
    {
        $paginator = Comment::query()
            ->with(['user', 'post'])
            ->where('post_id', $postId)
            ->latest()
            ->paginate($perPage);

        $items = array_map(
            fn (Comment $comment): CommentEntity => $this->mapper->toEntity($comment),
            $paginator->items(),
        );

        return new PaginatedResult(
            items: array_values($items),
            total: $paginator->total(),
            perPage: $paginator->perPage(),
            currentPage: $paginator->currentPage(),
            lastPage: $paginator->lastPage(),
        );
    }

    public function create(CommentEntity $comment): CommentEntity
    {
        $model = Comment::query()->create([
            'user_id' => $comment->userId,
            'post_id' => $comment->postId,
            'body'    => $comment->body,
        ]);

        $model->load('user');

        return $this->mapper->toEntity($model);
    }
}
