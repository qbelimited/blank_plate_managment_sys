<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helpandsupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'priority',
        'subject',
        'message'
    ];
}
