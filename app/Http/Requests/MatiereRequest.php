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
            'coeff'=>'required|numeric',
            'niveau'=>'required',
            'module'=>'required'


        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'ce champ est obligatoiore',
            'nom.max' => 'ce chanmp doit etre au maximum 25 characteres',
            'coeff.required' => 'ce champ est obligatoiore',
            'coeff.numeric'=>' la coefficient doit etre seulement des chiffres',
            'niveau.required'=>'ce champ est obligatoire',
            'module.required'=>'ce champ est obligatoire'

        ];
    }
}
