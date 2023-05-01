<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overhead extends Model
{
    use HasFactory;

    protected $fillable = [
        'overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
        'to_name', 'to_company', 'to_city', 'to_address', 'to_phone', 'type',
        'speed', 'payment', 'payment_type', 'description', 'order_id', 'author',
        'mass', 'volume', 'width', 'height', 'date_s', 'date_e', 'courier_id',
        'place', 'registry_id', 'status_id', 'check','spi', 'checker', 'sub_zone', 'image_file',
        'comment'
    ];

    public static function lastOverhead(){
        return Overhead::where('overhead_code', '<',150000)->where('overhead_code', '>',100000)
			->orderBy('overhead_code', 'DESC')->get()->first();
    }

    public function getOrder($overhead_id){
        return Order::find($overhead_id);
    }
}
