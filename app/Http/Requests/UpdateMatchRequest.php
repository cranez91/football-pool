<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'matchday_id' => 'required|integer|exists:matchdays,id',
            'home_team_id' => 'nullable|integer|exists:teams,id',
            'away_team_id' => 'nullable|integer|exists:teams,id',
            'home_national_team_id' => 'nullable|integer|exists:national_teams,id',
            'away_national_team_id' => 'nullable|integer|exists:national_teams,id',
            'broadcaster' => 'required|string|max:50',
            'result' => 'required|string|min:1|max:1',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
