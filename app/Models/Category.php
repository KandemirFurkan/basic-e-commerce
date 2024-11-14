<?php

namespace App\Models;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cocur\Slugify\Slugify;

class Category extends Model
{
    use Sluggable;

protected $fillable=[
    'name',
    'slug',
    'thumbnail',
    'image',
    'content',
    'cat_ust',
    'status' ,
];

public function images()
{
    return $this->hasOne(ImageMedia::class,'table_id','id')->where('model_name','Category');
}

public function items(){

    return $this->hasMany(Product::class,'category_id','id');


}

public function subcategory(){
    return $this->hasMany(Category::class,'cat_ust','id');
}

public function category(){
    return $this->hasOne(Category::class,'id','cat_ust');
}


public function sluggable(): array
{
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
}

public function customizeSlugEngine(Slugify $engine, $attribute)
    {
        $engine->activateRuleSet('turkish');

        return $engine;
    }


}
