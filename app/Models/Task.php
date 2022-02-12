<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
            'subject' => 'required|string',
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
            'subject' => 'Описание задачи',
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

    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'task_performer_id');
    }

    public function subTasks(bool $hideClosedTasks = true): HasMany
    {
        $result = $this->hasMany(Task::class, 'parent_task_id');
        if ($hideClosedTasks) {
            return $result->where('terminate_date', '=', null);
        } else {
            return $result;
        }
    }

    public function parentTask(): HasOne
    {
        return $this->HAsOne(Task::class, 'parent_task_id', 'id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
