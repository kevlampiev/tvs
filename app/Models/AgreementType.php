<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function rules()
    {
        return [
          'name'=>'required|min:3',
        ];
    }

    public function agreements()
    {
        return $this->hasMany(Agreement::class);
    }


}
