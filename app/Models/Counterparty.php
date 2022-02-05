<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Counterparty extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function staff(): HasMany
    {
        return $this->hasMany(CounterpartyEmployee::class);
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string|min:3'
        ];
    }
}
