<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * طبقة منطق العمل للمنشورات.
 *
 * الـ Service بيتعامل مع المستودع (عن طريق العقد) وبيغلّف أي قواعد عمل. الكنترولر
 * بينادي الـ Service بس ومايتعاملش مع Eloquent مباشرة.
 */
class PostService
{
    public function __construct(
        private readonly PostRepositoryInterface $posts,
    ) {
    }

    /**
     * @return LengthAwarePaginator<int, Post>
     */
    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return $this->posts->paginateWithRelations($perPage);
    }

    /**
     * ينشئ منشور لمستخدم ويرجّعه محمَّل بعلاقاته.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(int $userId, array $data): Post
    {
        $post = $this->posts->createForUser($userId, $data);

        return $this->posts->loadRelations($post);
    }

    /**
     * يرجّع منشور محمَّل بعلاقاته.
     */
    public function show(Post $post): Post
    {
        return $this->posts->loadRelations($post);
    }

    /**
     * يحدّث منشور ويرجّعه محمَّل بعلاقاته.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Post $post, array $data): Post
    {
        $updated = $this->posts->update($post, $data);

        return $this->posts->loadRelations($updated);
    }

    public function delete(Post $post): void
    {
        $this->posts->delete($post);
    }
}
