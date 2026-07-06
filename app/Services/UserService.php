<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

/**
 * طبقة منطق العمل للمستخدمين.
 *
 * بتغلّف الوصول للمستخدم المصادَق عن طريق حقن الـ Auth (DI) بدل استخدام
 * الـ facade العامة Auth مباشرةً في الكنترولرَز، فيبقى مصدر المستخدم واحد
 * وقابل للاختبار.
 */
class UserService
{
    public function __construct(
        private readonly AuthFactory $auth,
    ) {
    }

    /**
     * يرجّع المستخدم المصادَق حاليًا.
     *
     * @throws AuthenticationException لو مفيش مستخدم مصادَق.
     */
    public function current(): User
    {
        $user = $this->auth->guard()->user();

        if (! $user instanceof User) {
            throw new AuthenticationException();
        }

        return $user;
    }
}
