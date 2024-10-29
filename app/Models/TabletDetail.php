<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabletDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'os', 'ram', 'storage', 'screen_size', 'battery', 'camera'
    ];
}
