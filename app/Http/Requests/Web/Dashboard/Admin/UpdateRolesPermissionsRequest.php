<?php

namespace App\Http\Requests\Web\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRolesPermissionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'string', Rule::exists('roles', 'id'), 'distinct'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'string', Rule::exists('permissions', 'name'), 'distinct'],
        ];
    }
}
