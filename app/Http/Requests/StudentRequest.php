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
            
            

        ];
    }

    public function messages()
    {
        return [
            'nomEleve.required' => 'name cannot be empty.',
            'nomEleve.string' => 'only characters.',
            'prenomEleve.required' => 'name cannot be empty.',
            'prennomEleve.string' => 'only characters.',
            'gender.required' => 'name cannot be empty.',
            'niveau.required' => 'name cannot be empty.',
           





            

        ];
    }
}
