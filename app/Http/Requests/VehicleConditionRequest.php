<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleConditionRequest extends FormRequest
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
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_open' => 'required|date|before_or_equal:today',
            'condition' => ['required',
                Rule::in(['operable', 'repair', 'ruined']),
            ],
            'description' => 'string',
        ];
    }

    public function attributes()
    {
        return [
            'vehicle_id' => 'Единица техники',
            'date_open' => 'Дата возникновения состояния',
            'condition' => 'Вид состояния',
            'description' => 'Описание',

        ];
    }
}
