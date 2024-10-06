<?php

namespace App\Http\Requests\Web\Dashboard\RatingMembers;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingMembersRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:rating_members,email'],
            'password'  => ['required'],
            'college_id' => ['required'] ,
            'program_id' => ['sometimes'] ,
            'type' => ['required'] ,
        ];
    }
}
