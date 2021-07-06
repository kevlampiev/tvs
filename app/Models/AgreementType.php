<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function rules(): array
    {
        return [
            'name' => 'required|min:3',
        ];
    }

    public function agreements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Agreement::class);
    }


}
