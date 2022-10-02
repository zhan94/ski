<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KidRequest extends FormRequest
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
            'firstname' => 'required',
            'surname' => 'required',
            'lastname' => 'required',
            'birth_date' => 'required',
            'parent_name' => 'required',
            'parent_email' => 'required',
            'parent_phone_number' => 'required'
        ];
    }
}
