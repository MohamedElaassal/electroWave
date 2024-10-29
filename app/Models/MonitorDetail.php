<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'resolution', 'size', 'refresh_rate', 'panel_type'
    ];
}
