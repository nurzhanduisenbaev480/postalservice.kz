<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model{
    use HasFactory;

    protected $fillable = [
        'overhead_id', 'sum', 'mass', 'price', 'oil_price', 'date', 'length', 'width', 'height'
    ];

    public $timestamps = false;
}
