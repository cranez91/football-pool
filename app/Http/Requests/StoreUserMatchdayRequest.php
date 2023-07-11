<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserMatchdayRequest extends FormRequest
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
            //'user_id' => 'required|integer|exists:users,id',
            'matchday_slug' => 'required|string|exists:matchdays,slug',
            'paid' => 'required|integer|min:0|max:1',
            'winner' => 'required|integer|min:0|max:1',
            'predictions' => 'required|array',
            'predictions.*' => 'required|in:L,E,V',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
