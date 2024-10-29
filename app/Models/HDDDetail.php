<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HDDDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity', 'rpm', 'cache', 'interface'
    ];
}
