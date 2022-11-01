<?php

namespace App\Models;

use App\Models\Bill;
use App\Models\DeliveredItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceivedItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivered_item_id',
        'verified',
        'date_verified'
    ];

    public function Bill(){
        return $this->hasOne(Bill::class);
    }

    public function DeliveredItem(){
        return $this->belongsTo(DeliveredItem::class);
    }
}
