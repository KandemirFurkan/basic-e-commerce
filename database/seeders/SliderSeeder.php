<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{

    public function run()
    {

Slider::create([
    'image' => 'https://fakeimg.pl/250x100/',
    'name' => 'Slider 1',
    'seo' => 'urunler',
    'content' => 'E ticaret sitemize hoş geldiniz',
    'status' => '1'

]);

    }
}
