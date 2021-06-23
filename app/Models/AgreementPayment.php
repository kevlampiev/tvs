<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class AgreementPayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);

    }

    public static function rules()
    {
        return [
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'currency' => ['required',
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ]
        ];
    }
}
