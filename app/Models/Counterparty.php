<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function agreements()
    {
        return $this->hasMany(Agreement::class);
    }

    public static function rules():array
    {
        return [
          'name' => 'required|string|min:3'
        ];
    }
}
