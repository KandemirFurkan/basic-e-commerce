<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId=[1,2,3,4,5,6,7,8,9];
        $RandomSize=['XS','S','M','L','XL','XXL'];
        $RColor=['Beyaz','Siyah','Mavi','Yeşil','Gri','Mor'];
        $colortext=$RColor[random_int(0,5)];
        $sizeTest=$RandomSize[random_int(0,5)];
        return [
            'name'=>$colortext.' '.$sizeTest.' Ürün',
'category_id'=>$categoryId[random_int(0,8)],
'image'=>'https://fakeimg.pl/300x400',
'short_text'=>$categoryId[random_int(0,8)].'Lorem Ipsum pasajlarının birçok çeşitlemesi vardır. Ancak bunların büyük bir çoğunluğu mizah katılarak veya rastgele sözcükler eklenerek değiştirilmişlerdir.',
'price'=>random_int(10,500),
'size'=>$sizeTest,
'color'=>$colortext,
'piece'=>random_int(10,500),
'status'=>'1',
'content'=>'Text Metin'
        ];
    }
}
