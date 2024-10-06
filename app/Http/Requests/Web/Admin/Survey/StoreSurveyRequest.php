<?php

namespace App\Http\Requests\Web\Admin\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
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
            'name' =>['required'] ,
            'matarial_id' =>['required'] ,
            'status' => 'nullable|boolean', // or 'sometimes|boolean'
        ];
    }
}
