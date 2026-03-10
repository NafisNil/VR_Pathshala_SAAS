<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureTopic extends Model
{
    //
    protected $fillable = [
        'name',
        'short_description',
        'rating',
        'total_reviews',
        'image',
        'content_type_id',
    ];

    public function contentType()
    {
        return $this->belongsTo(ContentType::class);
    }
}
