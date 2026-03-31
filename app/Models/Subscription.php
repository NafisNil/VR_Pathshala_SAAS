<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;

class Subscription extends Model
{
    //
    protected $fillable = [
        'user_id',
        'plan_id',
        'expires_at',
        'started_at',
        'status',
        'cancel_req'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'plan_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }


    public function isActive()
    {
        // If it's inactive, it's dead.
        if ($this->status === 'inactive') {
            return false;
        }

        // If it's active but has an end date, check if that date has passed
        if ($this->expires_at && now()->greaterThan($this->expires_at)) {
            return false;
        }

        return true;
    }


}
