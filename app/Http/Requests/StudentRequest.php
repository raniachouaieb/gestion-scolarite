<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'nomEleve' => 'required| string',
            'prenomEleve' => 'required |string',
            'gender' => 'required',
            'niveau' => 'required',
            'birth'=> 'required'



        ];
    }

    public function messages()
    {
        return [
            'nomEleve.required' => 'ce champ est obligatoire.',
            'nomEleve.string' => 'only characters.',
            'prenomEleve.required' => 'ce champ est obligatoire.',
            'prennomEleve.string' => 'only characters.',
            'gender.required' => 'ce champ est obligatoire.',
            'niveau.required' => 'ce champ est obligatoire.',
            'birth.required'=> 'ce champ est obligatoire'








        ];
    }
}
