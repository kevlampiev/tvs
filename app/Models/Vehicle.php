<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'manufacturer_id',
        'name',
        'vin',
        'bort_number',
        'prod_year',
        'trademark',
        'model',
        'market_price',
        'currency',
        'estimate_date'];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
