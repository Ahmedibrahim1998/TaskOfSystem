<?php

namespace App\Application\Post\UseCases;

use App\Domain\Post\Entities\PostEntity;
use App\Domain\Post\Repositories\PostRepositoryInterface;
use App\Domain\Shared\PaginatedResult;

/**
 * Use Case: عرض قائمة المنشورات مقسّمة لصفحات.
 *
 * الـ Use Case بيعتمد على واجهة المستودع بس (مش على Eloquent)، وده اللي بيخلّي
 * منطق التطبيق قابل للاختبار ومستقل عن الإطار.
 */
final class ListPostsUseCase
{
    public function __construct(
        private readonly PostRepositoryInterface $posts,
    ) {
    }

    /**
     * @return PaginatedResult<PostEntity>
     */
    public function execute(int $perPage = 10): PaginatedResult
    {
        return $this->posts->paginate($perPage);
    }
}
