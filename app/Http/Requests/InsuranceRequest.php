<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InsuranceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'policy_number' => 'string|nullable',
            'vehicle_id' => 'required|exists:vehicles,id',
            'insurance_company_id' => 'required|exists:insurance_companies,id',
            'insurance_type_id' => 'required|exists:insurance_types,id',
            'date_open' => 'date|required',
            'date_close' => 'date|required|after:date_open',
            'insurance_amount' => 'numeric',
            'insurance_premiun' => 'numeric',
            'amount_currency' => [
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'premium_currency' => [
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'description' => 'string|required'
        ];
    }

    public function attributes(): array
    {
        return [
            'policy_number' => 'Номер страхового полиса',
            'date_open' => 'Дата начала действия',
            'date_close' => 'Дата окончания действия',
            'insurance_amount' => 'Страховая сумма',
            'insurance_premiun' => 'Страховая премия',
            'amount_currency' => 'Валюта страховой суммы',
            'premium_currency' => 'Валюта страховой премии',
            'description' => 'Описание'
        ];
    }

}
