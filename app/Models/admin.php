<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class admin extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
       'users_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
