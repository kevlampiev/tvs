<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
        ];
    }

    public function insurances()
    {
        return $this->hasMany(Insurance::class);
    }
}
