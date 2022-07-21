<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'purchase_date',
        'sale_date'];

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function agreements(): BelongsToMany
    {
        return $this->belongsToMany(Agreement::class);
    }

    public function insurances(): HasMany
    {
        return $this->hasMany(Insurance::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(VehicleNote::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(VehiclePhoto::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function incidents():HasMany
    {
        return $this->hasMany(VehicleIncident::class);
    }

    public function conditions():HasMany
    {
        return $this->hasMany(VehicleCondition::class);
    }

    public function placements():HasMany
    {
        return $this->hasMany(VehiclePlacement::class);
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
            'purchase_date' => 'date',
            'sale_date' => 'date',
        ];
    }

    public static function attributes(): array
    {
        return [
            'name' => 'Наименование оборудования',
            'vin' => 'Заводской номер/VIN',
            'bort_number' => 'Бортовой номер',
            'prod_year' => 'Год выпуска',
            'trademark' => 'Торговая марка',
            'model' => 'Модель',
            'currency' => 'Валюта',
            'price' => 'Цена приобретения',
            'purchase_date' => 'Дата приобретения',
            'sale_date' => 'Дата продажи',
        ];
    }
}
