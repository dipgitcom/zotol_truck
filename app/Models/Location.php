<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'post_id', 'location_name', 'latitude', 'longitude', 'distance'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
