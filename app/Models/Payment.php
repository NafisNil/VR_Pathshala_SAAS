<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Plan;
use App\Models\Subscription;

class Payment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'transaction_id',
        'payment_method',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'plan_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    
}
