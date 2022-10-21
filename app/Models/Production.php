<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_color_id',
        'plate_dimension_id',
        'batch_code',
        'quantity',
        'job_status',
        'serial_starts',
        'production_week_id',
        'production_year_id',
        'manufacture_date',
        'status'
    ];

            
}
