<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveredItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_id',
        'user_id',
        'delivered',
        'date',
        'company_id',
        'quantity',
        'cost'
    ];

    public function ReceivedItem(){
        return $this->hasOne(Bill::class);
    }
}
