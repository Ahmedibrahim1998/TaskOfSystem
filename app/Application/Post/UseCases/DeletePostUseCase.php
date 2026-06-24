<?php

namespace App\Application\Post\UseCases;

use App\Domain\Post\Exceptions\PostNotFoundException;
use App\Domain\Post\Repositories\PostRepositoryInterface;

/**
 * Use Case: حذف منشور بالمعرّف.
 */
final class DeletePostUseCase
{
    public function __construct(
        private readonly PostRepositoryInterface $posts,
    ) {
    }

    public function execute(int $id): void
    {
        $existing = $this->posts->findById($id)
            ?? throw PostNotFoundException::withId($id);

        $this->posts->delete((int) $existing->id);
    }
}
