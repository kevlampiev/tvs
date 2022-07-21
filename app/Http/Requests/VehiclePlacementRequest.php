<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiclePlacementRequest extends FormRequest
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
            'location_id' => 'required|exists:vehicle_locations,id',
            'date_open' => 'date|before_or_equal:today',
            'description' => 'string|nullable'
        ];
    }

    public function attributes()
    {
        return [
            'vehicle_id' => 'Единица техники',
            'location_id' => 'Местоположение',
            'date_open' => 'Дана установления местоположения',
            'description' => 'Описание'
        ];
    }

}
