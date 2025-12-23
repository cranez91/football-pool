<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMatchdayRequest extends FormRequest
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
            'name' => 'sometimes|string|max:100',
            'number_matches' => 'sometimes|integer',
            'tournament_id' => 'sometimes|integer|exists:tournaments,id',
            'active' => 'sometimes|integer|min:0|max:1',
            'visible' => 'sometimes|integer|min:0|max:1',
            'price' => 'sometimes|integer|min:0',
            'high_prize' => 'nullable|integer|min:0',
            'low_prize' => 'nullable|integer|min:0',
            'start_date' => 'sometimes|date_format:Y-m-d',
            'end_date' => 'sometimes|date_format:Y-m-d',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
