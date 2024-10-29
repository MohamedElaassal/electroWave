<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'cpu', 'ram', 'storage', 'gpu', 'motherboard', 'power_supply'
    ];
}
