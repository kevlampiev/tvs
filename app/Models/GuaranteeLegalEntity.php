<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GuaranteeLegalEntity extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Договор к которому относится поручительство
    public function agreement():BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }

    public function guarantor():HasOne
    {
        return $this->hasOne(Company::class,'id', 'guarantor_id');
    }

}
