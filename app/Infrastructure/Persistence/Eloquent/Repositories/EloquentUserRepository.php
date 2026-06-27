<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\User\Entities\UserEntity;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Mappers\UserMapper;
use App\Models\User;

/**
 * تنفيذ مستودع المستخدمين باستخدام Eloquent — طبقة Infrastructure.
 */
final class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly UserMapper $mapper = new UserMapper(),
    ) {
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $user = User::query()->where('email', $email)->first();

        return $user !== null ? $this->mapper->toEntity($user) : null;
    }

    public function getHashedPasswordByEmail(string $email): ?string
    {
        $password = User::query()->where('email', $email)->value('password');

        return is_string($password) ? $password : null;
    }

    public function create(string $name, string $email, string $hashedPassword): UserEntity
    {
        $user = User::query()->create([
            'name'     => $name,
            'email'    => $email,
            'password' => $hashedPassword,
        ]);

        return $this->mapper->toEntity($user);
    }
}
