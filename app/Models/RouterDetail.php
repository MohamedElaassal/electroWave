<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouterDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'speed', 'frequency_bands', 'ports'
    ];
}
