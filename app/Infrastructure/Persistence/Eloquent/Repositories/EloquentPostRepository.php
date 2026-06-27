<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Post\Entities\PostEntity;
use App\Domain\Post\Repositories\PostRepositoryInterface;
use App\Domain\Shared\PaginatedResult;
use App\Infrastructure\Persistence\Eloquent\Mappers\PostMapper;
use App\Models\Post;

/**
 * تنفيذ مستودع المنشورات باستخدام Eloquent — يعيش في طبقة Infrastructure.
 *
 * هو الجهة الوحيدة اللي بتلمس Post (موديل Eloquent)؛ بيحوّل كل خرج لكيانات Domain
 * عن طريق الـ Mapper قبل ما يرجّعه للطبقات الأعلى.
 */
final class EloquentPostRepository implements PostRepositoryInterface
{
    public function __construct(
        private readonly PostMapper $mapper = new PostMapper(),
    ) {
    }

    public function paginate(int $perPage): PaginatedResult
    {
        $paginator = Post::query()
            ->with(['user', 'comments.user'])
            ->latest()
            ->paginate($perPage);

        $items = array_map(
            fn (Post $post): PostEntity => $this->mapper->toEntity($post),
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

    public function findById(int $id): ?PostEntity
    {
        $post = Post::query()
            ->with(['user', 'comments.user'])
            ->find($id);

        return $post !== null ? $this->mapper->toEntity($post) : null;
    }

    public function create(PostEntity $post): PostEntity
    {
        $model = Post::query()->create([
            'user_id' => $post->userId,
            'title'   => $post->title,
            'slug'    => $post->slug,
            'content' => $post->content,
        ]);

        $model->load(['user', 'comments.user']);

        return $this->mapper->toEntity($model);
    }

    public function update(PostEntity $post): PostEntity
    {
        /** @var Post $model */
        $model = Post::query()->findOrFail($post->id);

        $model->update([
            'title'   => $post->title,
            'slug'    => $post->slug,
            'content' => $post->content,
        ]);

        $model->load(['user', 'comments.user']);

        return $this->mapper->toEntity($model);
    }

    public function delete(int $id): void
    {
        Post::query()->where('id', $id)->delete();
    }
}
