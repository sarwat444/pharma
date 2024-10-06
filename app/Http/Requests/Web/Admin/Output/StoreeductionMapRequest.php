<?php

namespace App\Http\Requests\Web\Admin\Output;

use Illuminate\Foundation\Http\FormRequest;

class StoreeductionMapRequest extends FormRequest
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
            'week_number' => ['required'] ,
            'teaching_outputs_id' => ['required'] ,
            'added_by' => ['required'] ,
            'matarial_id' => ['required'] ,
            'type' => ['required'] ,
            'main_type' => ['required'] ,
        ];
    }
}
