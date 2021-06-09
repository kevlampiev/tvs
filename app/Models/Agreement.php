<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agreement extends Model
{
    use HasFactory;
    protected $guarded = ['agreementType', 'company', 'counterparty'];

    public function AgreementType(): BelongsTo
    {
        return $this->belongsTo(AgreementType::class);
    }

    public function Company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function Counterparty():BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    public function payments()
    {
        return $this->hasMany(AgreementPayment::class);
    }
    public function realPayments()
    {
        return $this->hasMany(RealPayment::class);
    }
}
