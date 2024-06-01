<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'subject_id',
        'post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(User::class, 'subject_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public static function filterByCategory($category)
    {
        switch ($category) {
            case 'comments':
                return self::with('user')->where('message', 'LIKE', '%komentar%')->get();
            case 'likes':
                return self::with('user')->where('message', 'LIKE', '%disukai%')->get();
            default:
                return self::with('user')->get();
        }
    }

    
}
