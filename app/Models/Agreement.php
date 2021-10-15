<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class Agreement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function AgreementType(): BelongsTo
    {
        return $this->belongsTo(AgreementType::class);
    }

    public function Company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function Counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function vehicles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class);
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AgreementPayment::class);
    }

    public function realPayments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RealPayment::class);
    }

    public function notes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AgreementNote::class);
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
            'company_id' => 'required|exists:companies,id',
            'counterparty_id' => 'required|exists:counterparties,id',
            'agr_number' => 'required|string|min:3',
            'description' => 'string|nullable',
            'date_open' => 'date|nullable',
            'date_close' => 'date|nullable',
            'real_date_close' => 'date|nullable',
            'file_name' => 'string|nullable',
            'agreement_type_id' => 'required|exists:agreement_types,id',
            'principal_amount' => 'numeric',
            'currency' => [
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'interest_rate' => 'numeric'
        ];
    }
}
