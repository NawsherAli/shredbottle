<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_id',
        'amount',
        'charity_type',
        'charity_id',
        'no_of_items',
        'status',
        'pickup_id',
    ];

    public function donor()
    {
        return $this->belongsTo(Customer::class, 'donor_id');
    }

    public function charity()
    {
        return $this->belongsTo(Fundraiser::class, 'charity_id');
    }

    public function pickup()
    {
        return $this->belongsTo(Pickup::class, 'pickup_id');
    }
}

