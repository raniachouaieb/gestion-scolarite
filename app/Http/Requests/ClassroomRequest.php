<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'name' => 'required|max:10',
            'id_level'=>'required'



        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ce champ ne peut pas etre vide',
            'name.max' => 'ce champ ne dépasse pas le 10 caracteres',
            'id_level.required'=> 'Veuillez affecter un niveau'
        ];
    }
}
