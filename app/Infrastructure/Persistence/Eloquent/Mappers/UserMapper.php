<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\User\Entities\UserEntity;
use App\Models\User;

/**
 * Mapper بيحوّل موديل Eloquent (User) لكيان Domain (UserEntity).
 *
 * ده المكان الوحيد اللي بيعرف الشكلين مع بعض — فبيعزل الـ Domain تمامًا عن Eloquent.
 */
final class UserMapper
{
    public function toEntity(User $model): UserEntity
    {
        return new UserEntity(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            createdAt: $model->created_at !== null
                ? \DateTimeImmutable::createFromInterface($model->created_at)
                : null,
        );
    }
}
