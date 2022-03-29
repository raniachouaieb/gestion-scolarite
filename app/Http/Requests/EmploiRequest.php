<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmploiRequest extends FormRequest
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
            'titre' => 'required',
            'class' => 'required ',
            'niveau'=>'required'

        ];
    }

    public function messages()
    {
        return [
            'titre.required' => 'ce champ est obligatoire.',
            'class.required' => 'Veuillez selectionner une classe.',
            'niveau.required' => 'Veuillez selectionner un niveau.',

        ];
    }
}
