<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model{
    use HasFactory;

    protected $fillable = [
        'contract_id', 'tarif_id', 'company_name', 'mass', 'price', 'user_id', 'speed', 'price2', 'price3','overhead_id'
    ];

    public $timestamps = false;

}
