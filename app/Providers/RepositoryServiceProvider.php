<?php

namespace App\Providers;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * يربط عقود المستودعات (Contracts) بتنفيذها الفعلي (Eloquent).
 *
 * كده الـ Services بتطلب الـ Interface والـ Container بيحقن التنفيذ. لو حبّيت
 * تغيّر مصدر البيانات بتعدّل السطر هنا بس.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * خريطة الربط: عقد => تنفيذ.
     *
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        PostRepositoryInterface::class    => PostRepository::class,
        CommentRepositoryInterface::class => CommentRepository::class,
        UserRepositoryInterface::class    => UserRepository::class,
    ];
}
