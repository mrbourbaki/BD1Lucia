<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaFromRequest extends FormRequest
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
            'tipo'=>'required|max:10', 
            'capacidad'=>'required',
            'nombre'=>'required|max:30',
            'direccion'=>'required|max:50' ,
            'fk_lugar'=>'required', 
            'fk_club',
        ];
    }
}
