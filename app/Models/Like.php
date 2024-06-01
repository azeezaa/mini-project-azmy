<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = ['user_id', 'post_id', 'likeable_id', 'likeable_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function isLikedByUser($userId)
    {
        return $this->user_id === $userId;
    }

    public function likeable()
    {
        return $this->morphTo();
    }
}
