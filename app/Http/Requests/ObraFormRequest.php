<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObraFormRequest extends FormRequest
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
            'resumen'=>'required|max:400', 
            'precio'=>'required',
            'titulo'=>'required|max:30',
            'estatus_actividad'=>'required' ,
            'duracion'=>'required', 
            'fk_sala'=>'required'
        ];
    }
}
