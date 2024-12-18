<?php

namespace App\Http\Requests\Web\Admin\Myears;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMyearRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'] ,
            'program_id' =>['sometimes']
        ];
    }
}
