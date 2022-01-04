<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function rules(): array
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


    public static function attributes(): array
    {
        return [
            'task_performer_id' => 'Исполнитель задачи',
            'start_date' => 'ДАта начала исполнения',
            'due_date' => 'Дата окончания',
            'subject'=>'Описание задачи',
            'description' => 'Дополнительные данные',
            'parent_task_id' => 'Родительская задача',
        ];
    }

    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);

    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);

    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);

    }

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }

    //Потенциально сбойный элемент: возможно придется делать owner_key на поле task_performer_id
    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tasks_task_performer_id_foreign');

    }

    public function subTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }


    public function documents():BelongsToMany
    {
        return $this->belongsToMany(Document::class);
    }
}
