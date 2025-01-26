<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class reviews extends Model
{
  protected $fillable = ['rest_items_id', 'customers_id', 'rating', 'comment'];
  use HasFactory, Notifiable;


  function items()
  {
    return $this->belongsTo(restItem::class, 'rest_items_id');
  }


  function customers()
  {
    return $this->belongsTo(Customer::class, 'customers_id');
  }
}
