<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platetype extends Model
{
    use HasFactory;

    public function productions()
    {
        return $this->hasMany(Production::class, 'platetype_id', 'id');
    }
}
