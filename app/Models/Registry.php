<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'status_id', 'transport_type',
        'to', 'from', 'date_s', 'code', "count", "place"
    ];

    public function getOverheads($id){
        return Overhead::where('registry_id', $id)->get();
    }
    public function lastRegistry(){
        return Registry::orderBy('id', 'desc')->get()->first();
    }

}
