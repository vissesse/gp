<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PautaRequest extends FormRequest
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
            'estudante_id' => 'required',
            'tipo_avaliacao' => 'required',
            'nota' => 'required|numeric|min:0|max:20',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute não pode ser vazio',
            'max' => ':attribute nao poder ser superio a 20 ',
            'min' => ':attribute nao poder inferior a 0'

        ];
    }
}
