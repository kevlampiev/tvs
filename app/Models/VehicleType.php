<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function vehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|required|min:3',
        ];
    }
}
