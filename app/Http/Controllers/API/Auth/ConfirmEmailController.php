<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;

class ConfirmEmailController extends AuthController
{
    public function __invoke(User $user, string $hash)
    {
        if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return $this->boolResponse(false);
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return $this->boolResponse(true);
    }
}
