<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DeviceInfo extends Model
{
    //
    protected $fillable = [
        'device_id',
        'device_model',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
