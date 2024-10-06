<?php

namespace App\Http\Requests\Web\Admin\Output;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatarialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required'] ,
            'type' => ['required'] ,
            'name' => ['required', 'string', 'min:3', 'max:255'] ,
            'units' => ['required'] ,
            'nazary' => ['required'] ,
            'tamren' => ['required'] ,
            'amaly' => ['required'] ,
            'team' => ['required'] ,
            'section' => ['required'] ,
            'program_id' =>['required']
        ];
    }
}
