<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupItem extends Model
{   
    protected $table = 'pickup_items';
    protected $guarded = [];

    protected $fillable = [
        'pickup_id',
        'items_type',
        'no_of_bags',
        'no_of_boxes',
        'req_no_boxes',
        'quantity',
        'amount',
    ];

    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }

    public function itemDetails()
    {
        return $this->hasMany(ItemDetail::class);
    }
}
