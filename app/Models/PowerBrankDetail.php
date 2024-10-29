<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerBrankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity', 'output_ports', 'charging_time'
    ];
}
