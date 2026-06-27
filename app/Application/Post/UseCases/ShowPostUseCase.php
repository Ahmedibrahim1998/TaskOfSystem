<?php

namespace App\Application\Post\UseCases;

use App\Domain\Post\Entities\PostEntity;
use App\Domain\Post\Exceptions\PostNotFoundException;
use App\Domain\Post\Repositories\PostRepositoryInterface;

/**
 * Use Case: عرض منشور واحد بالمعرّف.
 */
final class ShowPostUseCase
{
    public function __construct(
        private readonly PostRepositoryInterface $posts,
    ) {
    }

    public function execute(int $id): PostEntity
    {
        return $this->posts->findById($id)
            ?? throw PostNotFoundException::withId($id);
    }
}
