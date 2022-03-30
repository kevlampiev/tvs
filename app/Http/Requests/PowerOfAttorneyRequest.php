<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PowerOfAttorneyRequest extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'issued_for' => 'required|string|min:3',
            'poa_number' => 'nullable|string',
            'subject' => 'required|string|min:10',
            'description' => 'string|nullable',
            'date_open' => 'required|date',
            'date_close' => 'required|date|after_or_equal:date_open',
        ];

    }

    public function attributes(): array
    {
        return [
            'company_id' => 'Доверитель',
            'issued_for' => 'На кого выписана доверенность',
            'poa_number' => 'Номер доверености',
            'subject' => 'Суть доверенности',
            'description' => 'Текст доверенности',
            'date_open' => 'Дата предоставления',
            'date_close' => 'Дата окончания',
        ];
    }


}
