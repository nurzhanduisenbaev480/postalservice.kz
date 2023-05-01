<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
        'to_name', 'to_company', 'to_city', 'to_address', 'to_phone', 'type',
        'speed', 'payment', 'payment_type', 'description', 'status_id', 'author', 'install_price','courier_id',
        'comment'
    ];

    public function author(){
        return $this->hasOne(User::class, 'id', 'author');
    }

    public function lastOrder(){
        return Order::orderBy('id', 'desc')->get()->first();
    }

    public function overheads(){
        return $this->hasMany(Overhead::class, 'order_id', 'id');
    }

    public function getCourier($id){
        return User::find($id);
    }

}
