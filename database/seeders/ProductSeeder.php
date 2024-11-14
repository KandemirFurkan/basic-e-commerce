<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


Product::create([

    'name' =>'Ürün 1',
    'image'=>'images/cloth_1.jpg',
    'category_id' =>1,
    'short_text' =>'Kısa bilgi',
    'price' =>100,
    'size' =>'Small',
    'color' =>'Beyaz',
    'piece' =>'10',
    'status' =>'1',
    'content' =>'<p>Uzun metin yazısı</p>'

]);

Product::create([

    'name' =>'Ürün 2',
    'image'=>'images/cloth_2.jpg',
    'category_id' =>2,
    'short_text' =>'Kısa bilgi 2',
    'price' =>150,
    'size' =>'Large',
    'color' =>'Siyah',
    'piece' =>'5',
    'status' =>'1',
    'content' =>'<p>Uzun açıklama yazısı 2</p>'

]);

    }
}
