<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model{
    use HasFactory;

    protected $fillable = [
        'overhead_code','shpi_code', 'status_id', 'is_active', 'date','status_name'
    ];

    public $timestamps = false;
}
