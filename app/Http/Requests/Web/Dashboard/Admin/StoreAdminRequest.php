<?php

namespace App\Http\Requests\Web\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('admins', 'name')],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')],
            'password'  => ['required'],
            'college_id' => ['required'] ,
            'program_id' => ['sometimes'] ,
            'type' => ['required'] ,
            'role' => ['required'] ,
            'mayear_id' => ['sometimes'],
            'matrial_id' => ['sometimes']
        ];
    }
}
