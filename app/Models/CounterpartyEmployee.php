<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounterpartyEmployee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string|min:5',
            'title' => 'nullable|string|min:5',
            'counterparty_id' => 'required|exists:counterparties, id',
            'email' => 'nullable|email',
            'birthday' => 'nullable|date',
            'description' => 'nullable|string',
        ];
    }

    public static function attributes(): array
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
