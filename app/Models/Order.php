<?php

namespace App\Models;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
   protected $fillable=['order_no','product_id','name','price','qty','kdv','status'];


public function product(){

return $this->hasOne(Product::class,'id','product_id');

}

}
