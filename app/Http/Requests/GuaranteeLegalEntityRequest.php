<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuaranteeLegalEntityRequest extends FormRequest
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
            'agreement_id' => 'required|exists:agreements,id',
            'guarantor_id' => 'required|exists:companies,id',
            'date_open' => 'date|required',
            'date_close' => 'date|required|after:date_open',
            'real_date_close' => 'date|nullable',
            'description' => 'string|nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'agreement_id' => 'Договор',
            'guarantor_id' => 'Поручитель',
            'date_open' => 'Дата начала срока поручителсьтва',
            'date_close' => 'Плановая дата окончания срока поручительства',
            'real_date_close' => 'Реальная дата прекращения поручителства',
            'description' => 'Описание',
        ];
    }

}
