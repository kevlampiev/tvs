<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
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
            'agreement_id' => 'required|exists:agreements,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_open' => 'required|date',
            'date_close' => 'required|date|after_or_equal:date_open',
            'real_date_close' => 'required|date|after_or_equal:date_open',
            'description' => 'nullable|string|min:5|max:254',
        ];
    }

    public function attributes(): array
    {
        return [
            'agreement_id' => 'Договор',
            'vehicle_id' => 'Единица техники',
            'date_open' => 'Дата начала залога',
            'date_close' => 'Плановая дата прекращения залога',
            'real_date_close' => 'Фактическая дата прекращения залога',
            'description' => 'Наименование договора залога/Комментарий',
        ];
    }

}
