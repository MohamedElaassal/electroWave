<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
       'Processeur' ,
       'Ram' ,
       'Camera' ,
       'Storage' ,
       'Baterie'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
