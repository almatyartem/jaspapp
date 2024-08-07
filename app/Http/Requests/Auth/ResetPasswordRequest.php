<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'string|required',
            'email' => 'email|required|exists:users,email',
            'password' => Password::min(8)->letters()->mixedCase()->numbers(),
        ];
    }
}
