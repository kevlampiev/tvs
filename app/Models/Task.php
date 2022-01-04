<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
            'description' => 'string|nullable'
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

//    public function performer(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//
//    }
}
