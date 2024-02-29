<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $table = 'pickups';
    protected $fillable = [
        'customer_id',
        'pickup_location',
        'pickup_date',
        'pickup_contact',
        'pickup_service',
        'payment_option',
        'charity_type',
        'charity_organization',
        'status',
        'total_items',
        'amount',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class,'charity_organization');
    }

    public function items()
	{
	    return $this->hasMany(PickupItem::class);
	}

}
