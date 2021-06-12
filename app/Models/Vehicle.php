<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

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
        'price',
        'currency',
        'purchase_date'];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function agreements()
    {
        return $this->belongsToMany(Agreement::class);
    }

    public static function rules():array
    {
        return [
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'name' => 'required|string|min:3',
            'vin' => 'required|string|min:10',
            'bort_number' => 'required|string|min:3',
            'prod_year' => 'required|numeric|min:1980',
            'trademark' => 'required|string|min:3',
            'model' => 'required|string|min:3',
            'currency' => ['required',
                Rule::in(['RUR', 'USD', 'EUR', 'CNY', 'YPN']),
            ],
            'price' => 'numeric|min:0',
            'purchase_date' => 'date'
        ];
    }
}
