<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function agreement():BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }

    public function vehicle():BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function insurance():BelongsTo
    {
        return $this->belongsTo(Insurance::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
