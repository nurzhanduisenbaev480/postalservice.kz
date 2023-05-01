<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model {
    use HasFactory;
    protected $fillable = [
        'registry_id', 'from_city', 'to_city', 'status', 'description', 'date_start', 'date_end', 'price'
    ];

    public $timestamps = false;
}

