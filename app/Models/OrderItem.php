<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','product_id','product_color_id','quantity','total_price'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function productColors(){
        return $this->belongsTo(ProductColor::class, 'product_color_id','id');
    }
}
