<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvocationRequest extends FormRequest
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
            'date_envoie' => 'required| date|after_or_equal:today',
            'titre_conv' => 'required |string',
            'description' => 'required',
            'elev'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'date_envoie.required' => 'date est obligatoire.',
            'date_envoie.date' => 'date doit etre format jj/mm/aaaa.',
            'date_envoie.after_or_equal'=>'La date  doit être supérieure ou égale à ce jour',
            'titre_conv.required' => 'jour est obligatoire.',
            'titre_conv.string' => 'le jour doit etre seulement des caracteres.',
            'description.required' => 'le menu est obligatoire.',
            'image.mimes'=>'image doit etre .jpeg .jpg ou gif',
            'image.required'=>'image est obligatoire',
            'elev.required'=>'Affectation de l\'eleve est obligatoire',








        ];
    }
}
