<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * عقد مستودع المنشورات.
 *
 * في نمط Service + Repository المستودع بيرجّع موديلات Eloquent مباشرة (مفيش Entities
 * ولا Mappers). الهدف هنا هو فصل منطق الوصول للبيانات عن منطق العمل (Service).
 */
interface PostRepositoryInterface
{
    /**
     * يرجّع المنشورات مقسّمة لصفحات مع علاقاتها.
     *
     * @return LengthAwarePaginator<int, Post>
     */
    public function paginateWithRelations(int $perPage = 10): LengthAwarePaginator;

    /**
     * ينشئ منشور جديد لمستخدم معيّن.
     *
     * @param  array<string, mixed>  $data
     */
    public function createForUser(int $userId, array $data): Post;

    /**
     * يحدّث منشور موجود.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Post $post, array $data): Post;

    /**
     * يحذف منشور.
     */
    public function delete(Post $post): void;

    /**
     * يحمّل علاقات المنشور (الكاتب والتعليقات).
     */
    public function loadRelations(Post $post): Post;
}
