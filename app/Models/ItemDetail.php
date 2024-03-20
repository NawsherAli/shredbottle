<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;
    
    protected $table = 'items_details';
    protected $guarded = [];

    public function pickupItem()
    {
        return $this->belongsTo(PickupItem::class,'pickup_item_id');
    }
}
