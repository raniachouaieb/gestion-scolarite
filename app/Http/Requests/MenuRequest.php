<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            //'id_menu'=>'required_without:'
            'date' => 'required| date|after_or_equal:today',
            'jour' => 'required |string',
            'menu' => 'required',
            'image' => 'required_without:id_menu|
                mimes:jpeg,jpg,gif'




        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'date est obligatoire.',
            'date.date' => 'date doit etre format jj/mm/aaaa.',
            'date.after_or_equal'=>'La date  doit être supérieure ou égale à ce jour',
            'jour.required' => 'jour est obligatoire.',
            'jour.string' => 'le jour doit etre seulement des caracteres.',
            'menu.required' => 'le menu est obligatoire.',
            'image.mimes'=>'image doit etre .jpeg .jpg ou gif',
            'image.required'=>'image est obligatoire',









        ];
    }
}
