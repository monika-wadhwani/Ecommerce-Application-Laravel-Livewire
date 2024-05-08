<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','tracking_no','name','email','phone_no','address','pincode','status_message','payment_mode','payment_id'];

    public function orderItems(){
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
}
