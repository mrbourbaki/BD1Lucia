<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectorFormRequest extends FormRequest
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
            'docidentidad'=>'required|max:12',
            'nombre1'=>'required|max:15',
            'apellido1'=>'required|max:15',
            'apellido2'=>'required|max:15',
            'telefono'=>'required|max:12',
            'nombre2'=>'max:15',
            'fk_rep',
            'fk_rep_externo'
    
        ];
    }
}
