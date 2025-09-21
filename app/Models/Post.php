<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'post_type', 'incident_area'
    ];

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    public function tags()
    {
        return $this->hasMany(PostTag::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function reactions()
    {
        return $this->hasMany(PostReaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
