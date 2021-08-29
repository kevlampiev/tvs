<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgreementMassPaymentRequest extends FormRequest
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
            'date_start' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'currency' => ['required',
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'repeat_count' => 'required|integer|min:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_date' => 'Дата платежа',
            'amount' => 'Сумма платежа',
            'currency' => 'Валюта платежа',
            'repeat_count' => 'Количество повторений',
        ];
    }

}
