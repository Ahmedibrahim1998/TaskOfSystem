<?php

namespace App\Actions\Posts;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Action: جلب المنشورات مقسّمة لصفحات مع علاقاتها.
 *
 * في نمط Action Classes كل عملية في كلاس مستقل بمسؤولية واحدة (Single Responsibility)،
 * من غير طبقة Service أو Repository.
 */
class ListPostsAction
{
    /**
     * @return LengthAwarePaginator<int, Post>
     */
    public function execute(int $perPage = 10): LengthAwarePaginator
    {
        return Post::query()
            ->with(['user', 'comments.user'])
            ->latest()
            ->paginate($perPage);
    }
}
