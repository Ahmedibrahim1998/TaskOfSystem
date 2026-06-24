<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * تنفيذ مستودع المنشورات باستخدام Eloquent.
 *
 * كل استعلامات الداتابيز الخاصة بالمنشورات بتتجمّع هنا، فلو احتجت تغيّر طريقة
 * الجلب أو تضيف caching بتعمله في مكان واحد.
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @return LengthAwarePaginator<int, Post>
     */
    public function paginateWithRelations(int $perPage = 10): LengthAwarePaginator
    {
        return Post::query()
            ->with(['user', 'comments.user'])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function createForUser(int $userId, array $data): Post
    {
        $data['user_id'] = $userId;

        return Post::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Post $post, array $data): Post
    {
        $post->update($data);

        return $post;
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }

    public function loadRelations(Post $post): Post
    {
        return $post->load(['user', 'comments.user']);
    }
}
