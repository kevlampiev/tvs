<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Config;

class VehicleCondition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicle():BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function name():string
    {
        $names = Config::get('constants.vehicleConditions');
        return $names[$this->condition];
    }
}
