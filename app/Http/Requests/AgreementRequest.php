<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgreementRequest extends FormRequest
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
            'name' => 'required|string|min:2',
            'company_id' => 'required|exists:companies,id',
            'counterparty_id' => 'required|exists:counterparties,id',
            'agr_number' => 'required|string|min:3',
            'description' => 'string|nullable',
            'date_open' => 'date|nullable',
            'date_close' => 'date|nullable',
            'real_date_close' => 'date|nullable',
            'file_name' => 'string|nullable',
            'agreement_type_id' => 'required|exists:agreement_types,id',
            'principal_amount' => 'numeric',
            'currency' => [
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'interest_rate' => 'numeric'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Наименование типа договора',
            'agr_number' => 'Номер договора',
            'description' => 'Описание договора',
            'date_open' => 'Дата заключения договора',
            'date_close' => 'Дата окончания договора (планируемая)',
            'real_date_close' => 'Дата окончания договора (реальная)',
            'file_name' => 'Имя файла догвоора',
            'principal_amount' => 'Основная сумма договора',
            'currency' => 'Валюта',
            'interest_rate' => 'Процентная ставка',
        ];
    }

}
