<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serialnumber extends Model
{
    use HasFactory;

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    public function plate()
    {
        return $this->belongsTo(Plate::class, 'serialnumber_id', 'id');
    }
}
