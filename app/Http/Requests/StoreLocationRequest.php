<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => 'required',
            'pick_up_place' => 'required',
            'drop_down_place' => 'required',
            'pick_up_time' => 'required',
            'drop_down_time' => 'required',
        ];
    }
}
