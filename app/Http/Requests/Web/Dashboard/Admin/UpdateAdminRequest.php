<?php

namespace App\Http\Requests\Web\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('admins', 'name')->ignore($this->admin->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($this->admin->id)],
            'photo'  => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'program_id' => ['sometimes'] ,
            'type' => ['required'] ,
            'mayear_id' => ['sometimes'] ,
            'matrial_id' => ['sometimes'] ,
            'role' => ['sometimes'] ,
        ];
    }
}
