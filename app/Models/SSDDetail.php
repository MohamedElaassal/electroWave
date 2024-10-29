<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSDDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity', 'interface', 'form_factor', 'read_speed', 'write_speed'
    ];
}
