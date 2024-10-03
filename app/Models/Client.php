<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
      'Name' ,
      'Phone' ,
      'Email' ,
      'img'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
