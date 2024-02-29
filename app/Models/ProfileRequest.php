<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileRequest extends Model
{
    use HasFactory;

    protected $table = 'profilerequests'; // '$table' should not have a dollar sign

    protected $fillable = [
        'user_id',
        'company_name',
        'name',
        'email',
        'contact',
        'charity_type',
        'address',
        'e_transfer_no',
        'vission_mission', // Typo: 'vission_mission' should be 'vision_mission'
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
