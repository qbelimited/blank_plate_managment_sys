<?php

namespace App\Models;

use App\Models\ReceivedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

            
    protected $fillable = [
        'received_item_id',
            'currency_id',
            'note',
            'ispaid',
            'paid_at',
            'paid_by',
            'method_of_payment',
            'isconfirmed',
            'invoice'
    ];

    public function ReceivedItem(){
        return $this->belongsTo(ReceivedItem::class);
    }
}
