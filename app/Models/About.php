<?php

namespace App\Models;

use App\Models\About;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class About extends Model
{
    protected $fillable = [

        'name',
        'content',
        'image',
        'text_1',
        'text_1_icon',
        'text_1_content',
        'text_2',
        'text_2_icon',
        'text_2_content',
        'text_3',
        'text_3_icon',
        'text_3_content'


    ];
    public function images()
    {
        return $this->hasOne(ImageMedia::class,'table_id','id')->where('model_name','About');
    }

}
