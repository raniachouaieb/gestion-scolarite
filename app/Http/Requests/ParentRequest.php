<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentRequest extends FormRequest
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
            'nomPere' => 'required| string',
            'prenomPere' => 'required |string',
            'telPere' => 'required',
            'professionPere' => 'required',
            'nomMere' => 'required',
            'prenomMere' => 'required',
            'telMere' => 'required',
            'professionMere' => 'required',
            'nbEnfants' => 'required|numeric', /** -1 innaceptable */
            'adresse' => 'required',
            'email' => 'required|email|unique:parentes',
            'password' => 'required'|'min:8',
            

        ];
    }

    public function messages()
    {
        return [
            'nomPere.required' => 'name cannot be empty.',
            'nomPere.string' => 'only characters.',
            'prenomPere.required' => 'name cannot be empty.',
            'prennomPere.string' => 'only characters.',
            'professionPere.required' => 'name cannot be empty.',
            'nomMere.required' => 'name cannot be empty.',
            'prenomMere.required' => 'name cannot be empty.',
            'telMere.required' => 'name cannot be empty.',
            'telPere.required' => 'name cannot be empty.',
            'professionMere.required' => 'name cannot be empty.',
            'nbEnfants.required' => 'name cannot be empty.',
            'adresse.reuired' => 'name cannot be empty.',
            'password.required' => 'name cannot be empty.',
            'password.min' => 'Minimum is 8.',
            'email.required' => 'cannot be empty.'





            

        ];
    }
}
