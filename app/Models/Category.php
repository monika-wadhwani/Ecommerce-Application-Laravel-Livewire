<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
 
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function brands(){
        return $this->hasMany(Brand::class,'category_id','id')->where('status',0);
    }
}
