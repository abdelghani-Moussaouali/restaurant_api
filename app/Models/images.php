<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;
    protected $fillable = ['rest_items_id', 'image_path'];
    function items()
    {
        return $this->belongsTo(restItem::class,'rest_items_id');
    }
}
