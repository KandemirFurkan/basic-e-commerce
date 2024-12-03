<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;


class Product extends Model implements Viewable
{
    use InteractsWithViews;
     use Sluggable,HasFactory;
   protected $fillable=[

    'name',
    'slug',
    'image',
    'category_id',
    'short_text',
    'price',
    'size',
    'kdv',
    'color',
    'piece',
    'status',
    'content',
    'title',
    'description',
    'keywords',
   ];

   public function images()
   {
       return $this->hasOne(ImageMedia::class,'table_id','id')->where('model_name','Product');
   }

public function category(){

return $this->hasOne(Category::class,'id','category_id');

}

public function sluggable(): array
{
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
}
}
