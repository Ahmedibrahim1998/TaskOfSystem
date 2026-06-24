<?php

namespace App\Providers;

use App\Domain\Auth\Services\PasswordHasherInterface;
use App\Domain\Auth\Services\TokenIssuerInterface;
use App\Domain\Comment\Repositories\CommentRepositoryInterface;
use App\Domain\Post\Repositories\PostRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Auth\BcryptPasswordHasher;
use App\Infrastructure\Auth\SanctumTokenIssuer;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentCommentRepository;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentPostRepository;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * يربط واجهات المستودعات (Domain) بتنفيذها الفعلي (Infrastructure).
 *
 * ده تطبيق مبدأ Dependency Inversion: الطبقات الأعلى بتطلب الواجهة، والـ Container
 * بيحقن التنفيذ المناسب. لو حبّيت تغيّر التخزين (مثلاً لـ API خارجي) بتغيّر السطر هنا بس.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * خريطة الربط: واجهة => تنفيذ.
     *
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        // المستودعات (Repositories)
        PostRepositoryInterface::class    => EloquentPostRepository::class,
        CommentRepositoryInterface::class => EloquentCommentRepository::class,
        UserRepositoryInterface::class    => EloquentUserRepository::class,

        // خدمات المصادقة (Auth Services)
        PasswordHasherInterface::class    => BcryptPasswordHasher::class,
        TokenIssuerInterface::class       => SanctumTokenIssuer::class,
    ];
}
