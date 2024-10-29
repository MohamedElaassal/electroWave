<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartwatchDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'os', 'battery_life', 'screen_type', 'sensor'
    ];
}
