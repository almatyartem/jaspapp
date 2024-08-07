<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'email|required|unique:users',
            'name' => 'required|string',
            'password' => Password::min(8)->letters()->mixedCase()->numbers(),
        ];
    }
}
