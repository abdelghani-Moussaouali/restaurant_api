<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['post', 'image','poster_id'];


    public function customers()
    {
        return $this->belongsTo(Customer::class, 'poster_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'posts_id');
    }
}
