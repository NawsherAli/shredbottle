<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','address','total_balance','current_balance'];

    public function pickups()
	{
	    return $this->hasMany(Pickup::class);
	}

	public function user()
    {
        return $this->belongsTo(User::class);
    }

}
