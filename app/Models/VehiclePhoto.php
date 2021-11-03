<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

class VehiclePhoto extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function vehicle():BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public static function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'comment' => 'string|nullable'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }
}
