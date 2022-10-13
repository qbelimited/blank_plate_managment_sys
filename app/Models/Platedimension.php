<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlateDimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'dimensions',
        'code',
        'status'
    ];
}
