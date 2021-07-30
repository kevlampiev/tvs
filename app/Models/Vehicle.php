<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function vehicleType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function manufacturer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function agreements(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Agreement::class);
    }

    public function insurances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Insurance::class);
    }

    public function notes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VehicleNote::class);
    }

    public static function rules(): array
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
