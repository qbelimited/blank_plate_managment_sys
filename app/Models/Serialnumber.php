<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serialnumber extends Model
{
    use HasFactory;

    public function production()
    {
        return $this->belongsTo('App\Production');
    }

    public function plate()
    {
        return $this->belongsTo('App\Plate', 'serialnumber_id', 'id');
    }
}
