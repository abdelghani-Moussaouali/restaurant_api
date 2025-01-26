<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'rest_items_id', 'item_menu'
    ];
    
    public function items()
    {
        return $this->belongsTo(restItem::class,'rest_items_id');
    }
}
