<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraphicsCardDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'memory', 'core_clock', 'boost_clock', 'tdp'
    ];
}
