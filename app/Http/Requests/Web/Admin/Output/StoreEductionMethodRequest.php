<?php

namespace App\Http\Requests\Web\Admin\Output;

use Illuminate\Foundation\Http\FormRequest;

class StoreEductionMethodRequest extends FormRequest
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
            'week_number' => ['required'] ,
            'name' =>  ['required'] ,
            'added_by' =>  ['required'] ,
            'matarial_id' => ['required']
        ];
    }
}
