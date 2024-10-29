<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeakersDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'power_output', 'connectivity', 'frequency_response'
    ];
}
