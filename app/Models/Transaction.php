<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

     protected $fillable = [
        'request_id',
        'customer_id',
        'fundraiser_id',
        'type',
        'amount',
        'transaction_no',
        'request_date',
        'transaction_date',
        'e_transfer_no',
        'status',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function fundraiser()
    {
        return $this->belongsTo('App\Models\Fundraiser', 'fundraiser_id');
    }
}
