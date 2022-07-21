<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VehiclePlacement extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function vehicle():HasOne
    {
        return $this->hasOne(Vehicle::class, 'id' , 'vehicle_id');
    }

    public function location():HasOne
    {
        return $this->hasOne(VehicleLocation::class, 'id', 'location_id');
    }
}
