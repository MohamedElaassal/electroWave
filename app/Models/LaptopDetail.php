<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpu', 'ram', 'storage', 'gpu', 'battery', 'screen_size'
    ];
}
