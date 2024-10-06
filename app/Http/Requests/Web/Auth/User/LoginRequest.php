<?php

namespace App\Http\Requests\Web\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules():array
    {
        return [
            'email' => ['required', 'email','max:50'],
            'password' => ['required', 'string','max:20'],
        ];
    }
}
