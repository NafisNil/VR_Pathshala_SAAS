<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    //
    protected $fillable = [
        'name',
        'short_description',
        'icon',
    ];
}
