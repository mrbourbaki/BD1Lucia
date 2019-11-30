<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibroFormRequest extends FormRequest
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
            'nombre'=>'required|max:50', //(estoy mostrando que es obligatorio)
            'descripcion'=> 'max:100' //VARCHAR(100) NOT NULL,  (aqui estoy mostrando que es opcional )
        ];
    }
}
