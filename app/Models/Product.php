<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'long_description',
        'original_price',
        'selling_price',
        'quantity',
        'status',
        'trending',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'featured'
    ];

    public function products_images(){
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }

    public function categories(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function productColors(){
        return $this->hasMany(ProductColor::class,'product_id','id');
    }
}
