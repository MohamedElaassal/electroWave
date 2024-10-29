<?php

namespace App\Models;

use App\Models\Product;
use App\Models\PCDetail;
use App\Models\HDDDetail;
use App\Models\NicDetail;
use App\Models\SSDDetail;
use App\Models\MouseDetail;
use App\Models\PhoneDetail;
use App\Models\CameraDetail;
use App\Models\LaptopDetail;
use App\Models\RouterDetail;
use App\Models\TabletDetail;
use App\Models\ChergerDetail;
use App\Models\MonitorDetail;
use App\Models\PrinterDetail;
use App\Models\KeyboardDetail;
use App\Models\SpeakersDetail;
use App\Models\HeadphonesDetail;
use App\Models\PowerBrankDetail;
use App\Models\SmartwatchDetail;
use App\Models\MotherboardDetail;
use App\Models\GraphicsCardDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [

       'type',
       'product_id',
       'data'
    ];

    protected $casts = [
        'data' => 'array', // This will ensure JSON is handled correctly
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function resolveDetailType($category)
    {
        switch ($category) {
            case 'Phone':
                return 'Phone';
            case 'NIC':
                return 'NIC';
            case 'PC':
                return 'PC';
            case 'Keyboard':
                return 'Keyboard';
            case 'Monitor':
                return 'Monitor';
            case 'Laptop':
                return 'Laptop';
            case 'Tablet':
                return 'Tablet';
            case 'Smartwatch':
                return 'Smartwatch';
            case 'Router':
                return 'Router';
            case 'Headphones':
                return 'Headphones';
            case 'Speakers':
                return 'Speakers';
            case 'Mouse':
                return 'Mouse';
            case 'Printer':
                return 'Printer';
            case 'Camera':
                return 'Camera';
            case 'Charger':
                return 'Charger';
            case 'Power Bank':
                return 'Power Bank';
            case 'Graphics Card':
                return 'Graphics Card';
            case 'Motherboard':
                return 'Motherboard';
            case 'SSD':
                return 'SSD';
            case 'HDD':
                return 'HDD';
            default:
                return self::class;
        }
    }

}
