<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RealPaymentRequest extends FormRequest
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
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'currency' => ['required',
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'description' => 'string|nullable'
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_date' => 'Дата платежа',
            'amount' => 'Сумма',
            'currency' => 'Валюта',
            'description' => 'Комментарий'
        ];
    }
}
