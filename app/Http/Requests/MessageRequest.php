<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MessageRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'subject'=>'nullable|string',
            'description' => 'string|nullable',
            'task_id' => 'nullable|exists:tasks,id',
            'reply_to_message_id' => 'nullable|exists:messages,id'
        ];

    }

    public function attributes(): array
    {
        return [
            'user_id' => 'пользователь',
            'subject'=>'Заголовок',
            'description' => 'Текст сообщения',
            'task_id' => 'Задача',
            'reply_to_message_id' => 'Сообщение на которое дается комментарий'
        ];
    }


}
