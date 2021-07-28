<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'inn' => 'required|string|min:10|max:12',
            'code' => 'required|string|min:2|max:10',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'наименование компании',
            'code' => 'краткий код компании',
        ];
    }

}
