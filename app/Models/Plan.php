<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
class Plan extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'status',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    
}
