<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleCondition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicle():BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
