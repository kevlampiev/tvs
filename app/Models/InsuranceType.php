<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function insurances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Insurance::class);
    }

    public static function rules():array
    {
        return [
            'name' => 'required|min:3',
        ];
    }
}
