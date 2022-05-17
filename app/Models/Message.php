<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function rules(): array
    {
        return [
            'subject' => 'required|string',
            'description' => 'string|nullable',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'agreement_id' => 'nullable|exists:agreements,id',
            'company_id' => 'nullable|exists:companies,id',
            'counterparty_id' => 'nullable|exists:counterparties,id',
        ];
    }

    public static function attributes(): array
    {
        return [
            'subject' => 'Заголовок сообщения',
            'description' => 'Текст сообщения',
            'counterparty_id' => 'Контрагент',
            'company_id' => 'Компания',
            'agreement_id' => 'Договор',
            'vehicle_id' => 'Оборудование',
        ];
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);

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

    public function parentMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'id', 'reply_to_message_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Message::class, 'reply_to_message_id', 'id');
    }


}
