<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'code',
        'status'
    ];
}
