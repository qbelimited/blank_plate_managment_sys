<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embosser extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_id',
        'embosser_color_id',
        'serial_number_id',
        'embosser_text',
        'status'
    ];

    public function Plate(){
        return $this->belongsTo(Plate::class);
    }


}
