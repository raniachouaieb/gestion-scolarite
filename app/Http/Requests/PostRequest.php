<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'level' => 'required',
            'name' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'level.reuired' => 'Level cannotbe empty.',
            'name.required' => 'Please enter a name for this field.',
        ];
    }
}
