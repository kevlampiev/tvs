<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'task_performer_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after:start_date',
            'subject'=>'required|string',
            'description' => 'string|nullable',
            'parent_task_id' => 'nullable|exists:tasks,id'
        ];

    }

    public function attributes(): array
    {
        return [
            'task_performer_id' => 'Исполнитель задачи',
            'start_date' => 'Дата начала исполнения',
            'due_date' => 'Дата окончания',
            'subject'=>'Описание задачи',
            'description' => 'Дополнительные данные',
            'parent_task_id' => 'Родительская задача',
        ];
    }


}
