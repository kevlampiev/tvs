<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class);
    }

    public function poas():hasMany
    {
        return $this->hasMany(PowerOfAttorney::class);
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'code' => 'required|string|min:3|max:10',
        ];
    }
}
