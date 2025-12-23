<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateDistribuitorRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:10',
            'commission_pct' => 'nullable|integer|min:0|max:100',
            'active' => 'nullable|integer|min:0|max:1',
        ];
    
        // Agregar reglas de contraseña solo si la contraseña está presente en la solicitud
        if ($this->filled('password')) {
            $rules['password'] = 'required|string|min:8|max:100|confirmed';
            $rules['password_confirmation'] = 'required|string|min:8|max:100|same:password';
        }
    
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
