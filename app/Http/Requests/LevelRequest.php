<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
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
            'level' => 'required|max:10',


        ];
    }

    public function messages()
    {
        return [
            'level.required' => 'ce champs est obligatoire.',
            'level.max' => 'le niveau ne peut pas dépasser le 10 caracteres'
        ];
    }
}
