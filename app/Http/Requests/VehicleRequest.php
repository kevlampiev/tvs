<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
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
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'name' => 'required|string|min:3',
            'vin' => 'required|string|min:10',
            'bort_number' => 'required|string|min:3',
            'prod_year' => 'required|numeric|min:1980',
            'trademark' => 'required|string|min:3',
            'model' => 'required|string|min:3',
            'currency' => ['required',
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'price' => 'numeric|min:0',
            'purchase_date' => 'date'
        ];
    }
}
