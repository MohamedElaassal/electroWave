<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Client;
use App\Models\Detail;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
       'Name' ,
       'Price' ,
       'IsNew' ,
       'brand_id',
       'img',
       'category_id',
       'available',
       'client_id',
       'amount_paid',  // Changed from Amount_paid to amount_paid
       'payment_type'
    ];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detail()
    {
        return $this->hasOne(Detail::class, 'product_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
