<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'liker_id',
        'posts_id',
    ];
    public function posts()
    {
        return $this->belongsTo(Post::class,'posts_id');
    }

}
