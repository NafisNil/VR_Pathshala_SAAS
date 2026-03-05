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


}
