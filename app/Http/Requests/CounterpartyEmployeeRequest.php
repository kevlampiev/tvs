<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CounterpartyEmployeeRequest extends FormRequest
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
            'name' => 'required|string|min:5',
            'title' => 'nullable|string|min:5',
            'counterparty_id' => 'required|exists:counterparties,id',
            'email' => 'nullable|email',
            'birthday' => 'nullable|date',
            'description' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Имя сотрудника',
            'title' => 'Должность',
            'counterparty_id' => 'Контрагент',
            'email' => 'Адрес электронной почты',
            'birthday' => 'День рождения',
            'description' => 'Дополнительная информация',
        ];
    }

}
