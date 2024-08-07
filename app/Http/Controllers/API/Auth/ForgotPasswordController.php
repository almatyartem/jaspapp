<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Responses\FailResponse;
use App\Mails\Auth\ResetPasswordMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends AuthController
{
    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::query()->where(
            'email',
            $request->validated('email')
        )->first();

        $token = Password::broker()->createToken($user);

        Mail::to($user->email)->send(new ResetPasswordMail($user, $token));

        return $this->boolResponse(true);
    }
}
