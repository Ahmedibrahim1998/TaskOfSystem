<?php

namespace App\Application\Post\UseCases;

use App\Application\Post\DTOs\CreatePostDTO;
use App\Domain\Post\Entities\PostEntity;
use App\Domain\Post\Repositories\PostRepositoryInterface;

/**
 * Use Case: إنشاء منشور جديد.
 *
 * بيحوّل الـ DTO القادم من الـ Controller لكيان Domain، وبيسلّمه للمستودع للحفظ.
 */
final class CreatePostUseCase
{
    public function __construct(
        private readonly PostRepositoryInterface $posts,
    ) {
    }

    public function execute(CreatePostDTO $dto): PostEntity
    {
        $post = new PostEntity(
            id: null,
            userId: $dto->userId,
            title: $dto->title,
            slug: $dto->slug,
            content: $dto->content,
        );

        return $this->posts->create($post);
    }
}
