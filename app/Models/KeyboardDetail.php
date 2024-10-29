<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyboardDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', 'switch_type', 'backlight'
    ];
}
