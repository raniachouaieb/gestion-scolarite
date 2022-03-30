<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeanceRequest extends FormRequest
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
            'day' => 'required',
            'start_time' => 'required |date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'emploi'=>'required',
            'niveau'=>'required',
            'matiere'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'day.required' => 'veuillez selectionner un jour.',
            'start_time.required' => 'veuillez saisir le debut de séance.',
            'start_time.date_format'=>'Respectez le format de la date h:i',
            'end_time.required' => 'veuillez saisir la fin de la séance',
            'end_time.date_format'=>'Respectez le format de la date h:i',
            'end_time.after' => 'la fin de la séance doit etre superieu a la date de debut.',
            'emploi.required'=>'selectionner un emploi',
            'niveau.required'=>'selectionner un niveau',
            'matiere.required'=>'selectionner une matiere',

        ];
    }
}
