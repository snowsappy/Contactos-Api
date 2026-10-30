<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    { 
        return [
            'email'=>['required'],
            'password'=> ['required','string'],
            'device'=>['required','string'],
        ];
    }

    //investigar para que se requiere
    public function messages(){
       return[
        'email.required'=>'el correo es requerido',
        'email.unique'=>'el email ya existe',
        'password.required'=>'por favor ingrese una contraseña',
        'email.email'=>'correo invalido'
       ];
    }
}
