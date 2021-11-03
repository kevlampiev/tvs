<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiclePhotoAddRequest extends FormRequest
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
            'vehicle_id' => 'required|exists:vehicles,id',
            'comment' => 'string|nullable',
            'img_file' => 'file|required',
        ];
    }

    public function attributes(): array
    {
        return [
            'vehicle_id' => 'Ссылка на единицу техники',
            'comment' => 'Комментарий',
            'img_file' => 'Имя файла',
        ];
    }

}
