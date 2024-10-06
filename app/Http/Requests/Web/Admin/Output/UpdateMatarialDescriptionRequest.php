<?php

namespace App\Http\Requests\Web\Admin\Output;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatarialDescriptionRequest extends FormRequest
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
            'type' => ['required'] ,
            'matarial_content' => ['required'] ,
            'educaion_method' => ['required'] ,
            'time' => ['required'] ,
            'takwem_methods' => ['required'] ,
            'innvoice' => ['required'] ,
            'matarial_id' => ['sometimes']
        ];
    }
}
