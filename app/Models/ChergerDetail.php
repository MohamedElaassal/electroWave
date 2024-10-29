<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChergerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'power_output', 'ports', 'type'
    ];
}
