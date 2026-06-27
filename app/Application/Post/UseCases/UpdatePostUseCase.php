<?php

namespace App\Application\Post\UseCases;

use App\Application\Post\DTOs\UpdatePostDTO;
use App\Domain\Post\Entities\PostEntity;
use App\Domain\Post\Exceptions\PostNotFoundException;
use App\Domain\Post\Repositories\PostRepositoryInterface;

/**
 * Use Case: تعديل منشور موجود (تعديل جزئي مدعوم).
 *
 * بيجيب الكيان الحالي، يدمج عليه التعديلات المرسلة بس، ويحفظ النتيجة.
 */
final class UpdatePostUseCase
{
    public function __construct(
        private readonly PostRepositoryInterface $posts,
    ) {
    }

    public function execute(int $id, UpdatePostDTO $dto): PostEntity
    {
        $existing = $this->posts->findById($id)
            ?? throw PostNotFoundException::withId($id);

        $updated = $existing->withChanges(
            title: $dto->title,
            slug: $dto->slug,
            content: $dto->content,
        );

        return $this->posts->update($updated);
    }
}
