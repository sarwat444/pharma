<?php

namespace App\Http\Requests\Web\Admin\programs;

use Illuminate\Foundation\Http\FormRequest;

class storeProgrameDescriptionReqest extends FormRequest
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
            'program' => ['required', 'string', 'min:3', 'max:255'],
            'type' => ['sometimes'],
            'section' => ['sometimes'] ,
            'added_date' => ['sometimes'] ,
            'program_id' => ['required']
        ];
    }
}
