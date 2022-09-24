<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    public function dimension()
    {
        return $this->belongsTo('App\Platedimensions');
    }

    public function platetype()
    {
        return $this->belongsTo('App\Platetype');
    }

    public function serials()
    {

        return $this->hasMany('App\Serialnumber', 'production_id', 'id');
    }
}
