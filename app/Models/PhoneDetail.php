<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'os', 'ram', 'storage', 'battery', 'camera', 'processor'
    ];
}
