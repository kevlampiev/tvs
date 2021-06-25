<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class RealPayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function rules(): array
    {
        return [
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'currency' => ['required',
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'description' => 'string|nullable'
        ];
    }
}
