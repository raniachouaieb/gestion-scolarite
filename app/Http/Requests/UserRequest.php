<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required| string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            //'password_confirm' => 'required|min:8|confirmed'


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'saisir votre nom.',
            'email.required' => 'Saisir votre email',
            'email.email' => 'saisir une correcte adresse email.',
            'email.unique' => 'cet email est déja existe',
            'password.required' => 'saisir mot de passe.',
            'password.confirmed' => ' mot de passe pas conforme',
            'password.min'=>'minimum 8 caracteres',
            'password_confirm.required'=>'obligatoire',
            'password_confirm.min'=>'minimum 8',
            'password_confirm.same'=>'pas conforme',








        ];
    }
}
