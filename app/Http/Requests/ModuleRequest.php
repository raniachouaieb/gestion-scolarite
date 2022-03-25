<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'nom_module' => 'required| max:25',
            'coefficient_module'=>'required|numeric',


        ];
    }

    public function messages()
    {
        return [
            'nom_module.required' => 'ce champ est obligatoiore',
            'nom_module.max' => 'ce chanmp doit etre au maximum 25 characteres',
            'coefficient_module.required' => 'ce champ est obligatoiore',
            'coefficient_module.numeric'=>' la coefficient doit etre seulement des chiffres',

        ];
    }
}
