<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadphonesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'connectivity', 'noise_cancellation'
    ];
}
