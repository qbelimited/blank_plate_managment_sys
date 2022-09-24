<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    public function dimension()
    {
        return $this->belongsTo(Platedimension::class);
    }

    public function platetype()
    {
        return $this->belongsTo(Platetype::class);
    }

    public function serials()
    {

        return $this->hasMany(Serialnumber::class, 'production_id', 'id');
    }
}
