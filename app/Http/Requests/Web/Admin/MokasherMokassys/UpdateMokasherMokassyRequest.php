<?php

namespace App\Http\Requests\Web\Admin\MokasherMokassys;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMokasherMokassyRequest extends FormRequest
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
            'name' =>['required'],
            'mayear_mokassy_id' => ['sometimes']
        ];
    }
}
