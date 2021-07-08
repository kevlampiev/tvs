<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class Insurance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    public function insuranceType(): BelongsTo
    {
        return $this->belongsTo(InsuranceType::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public static function rules(): array
    {
        return [
            'policy_number' => 'string|nullable',
            'vehicle_id' => 'required|exists:vehicles,id',
            'insurance_company_id' => 'required|exists:insurance_companies,id',
            'insurance_type_id' => 'required|exists:insurance_types,id',
            'date_open' => 'date|required',
            'date_close' => 'date|required|after:date_open',
            'insurance_amount' => 'numeric',
            'insurance_premiun' => 'numeric',
            'amount_currency' => [
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'premium_currency' => [
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'description' => 'string|required'
        ];
    }
}
