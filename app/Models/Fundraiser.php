<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    use HasFactory;

     protected $fillable = ['user_id','company_name','address','vision_mission','total_balance','current_balance','goal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pickups()
	{
	    return $this->hasMany(Pickup::class);
	}
    public function donations()
    {
        return $this->hasMany(Pickup::class);
    }
}
