<?php

namespace App\Actions\Auth;

use App\Models\User;

/**
 * Action: تسجيل الخروج بإلغاء التوكِن الحالي.
 */
class LogoutUserAction
{
    public function execute(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
