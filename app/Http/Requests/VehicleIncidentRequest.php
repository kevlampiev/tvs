<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleIncidentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_open' => 'required|date',
            'description' => 'required|string|min:10'
        ];
    }

    public function attributes(): array
    {
        return [
            'vehicle_id' => 'Единица техники',
            'date_open' => 'Дата инцидента',
            'description' => 'Описание инцидента'
        ];
    }
}
