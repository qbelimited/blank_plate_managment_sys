<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platedimension extends Model
{
    use HasFactory;

    public function productions()
    {

        return $this->hasMany('App\Production', 'platedimension_id', 'id');
    }
}
