<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public static function rules(): array
    {
        return [
            'subject'=>'required|string',
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


}
