<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'users_id'
    ];
    function items()
    {
        return $this->hasMany(restItem::class,); //'customers_id'
    }

    function review()
    {
        return $this->hasMany(reviews::class, 'customers_id');
    }

    function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'poster_id');
    }
}
