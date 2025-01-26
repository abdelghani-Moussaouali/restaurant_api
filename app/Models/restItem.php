<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class restItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'company_email',
        'customers_id',
        'phone_number',
        'category',
        'wilaya',
        'address'
    ];
    use HasFactory;
    public function images()
    {
        return $this->hasMany(images::class,'rest_items_id');
    }
    public function menu()
    {
        return $this->hasMany(menu::class,'rest_items_id');
    }
    public function review()
    {
        return $this->hasMany(reviews::class,'rest_items_id');
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class,);
    }
}
