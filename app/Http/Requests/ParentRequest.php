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
            'prenomPere' => 'required |string|regex:/^[A-Za-z]+$/',
            'telPere' => 'required',
            'professionPere' => 'required',
            'nomMere' => 'required| string',
            'prenomMere' => 'required| string',
            'telMere' => 'required',
            'professionMere' => 'required| string',
            'nbEnfants' => 'required|numeric', /** -1 innaceptable */
            'adresse' => 'required',
            'email' => 'required|email|unique:parentes,email',
            'password' => 'required|min:8',
            'image_profile'=>'required'


        ];
    }

    public function messages()
    {
        return [
            'nomPere.required' => 'ce champ est obligatoire.',
            'nomPere.regex' => 'only characters.',
            'prenomPere.required' => 'ce champ est obligatoire.',
            'prennomPere.string' => 'only characters.',
            'professionPere.required' => 'ce champ est obligatoire.',
            'nomMere.required' => 'ce champ est obligatoire.',
            'nomMere.string' => 'only characters.',
            'prenomMere.required' => 'ce champ est obligatoire.',
            'prenomPere.string' => 'only characters.',
            'professionMere.required' => 'ce champ est obligatoire.',
            'telMere.required' => 'ce champ est obligatoire.',
            'telPere.required' => 'ce champ est obligatoire.',
            'nbEnfants.required' => 'ce champ est obligatoire.',
            'adresse.required' => 'ce champ est obligatoire.',
            'password.required' => 'ce champ est obligatoire.',
            'password.min' => 'Minimum is 8.',
            'email.required' => 'ce champ est obligatoire.',
            'email.email'=>'enter a valid address mail',
            'email.unique'=>'email existe',
            'image_profile.required'=>'image est obligatoire'








        ];
    }
}
