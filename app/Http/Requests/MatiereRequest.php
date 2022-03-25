<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatiereRequest extends FormRequest
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
            'nom' => 'required| max:25',
            'coefficient'=>'require|numeric',


        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'ce champ est obligatoiore',
            'nom.max' => 'ce chanmp doit etre au maximum 25 characteres',
            'coefficient.required' => 'ce champ est obligatoiore',
            'coefficient.numeric'=>' la coefficient doit etre seulement des chiffres',

        ];
    }
}
