<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    
}
