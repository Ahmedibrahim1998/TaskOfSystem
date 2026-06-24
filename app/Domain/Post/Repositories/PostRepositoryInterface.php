<?php

namespace App\Domain\Post\Repositories;

use App\Domain\Post\Entities\PostEntity;
use App\Domain\Shared\PaginatedResult;

/**
 * عقد (Contract) مستودع المنشورات — معرّف في طبقة الـ Domain.
 *
 * الطبقات الأعلى بتعتمد على الواجهة دي بس (Dependency Inversion)، والتنفيذ
 * الفعلي بـ Eloquent بيعيش في طبقة Infrastructure ويترِبط عن طريق الـ Service Provider.
 */
interface PostRepositoryInterface
{
    /**
     * يرجّع المنشورات مقسّمة لصفحات.
     *
     * @return PaginatedResult<PostEntity>
     */
    public function paginate(int $perPage): PaginatedResult;

    /**
     * يرجّع منشور بالمعرّف مع علاقاته، أو null لو مش موجود.
     */
    public function findById(int $id): ?PostEntity;

    /**
     * ينشئ منشور جديد ويرجّع الكيان بعد الحفظ (بمعرّف وتواريخ وعلاقات).
     */
    public function create(PostEntity $post): PostEntity;

    /**
     * يحدّث منشور موجود بالكامل ويرجّع الكيان بعد الحفظ.
     */
    public function update(PostEntity $post): PostEntity;

    /**
     * يحذف منشور بالمعرّف.
     */
    public function delete(int $id): void;
}
