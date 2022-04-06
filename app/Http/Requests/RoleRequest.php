<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'role' => 'required|string|unique:roles,name',
            'permission' => 'required',



        ];
    }

    public function messages()
    {
        return [
            'role.required' => 'role est obligatoire.',
            'permission.required' => 'permission obligatoire',
            'role.string' => 'role doit etre seulement des caracteres',
            'role.unique'=>'cette rôle esxiste déja'









        ];
    }
}
