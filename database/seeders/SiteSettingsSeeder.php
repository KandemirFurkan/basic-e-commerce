<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

SiteSettings::create([

    'name' =>'adres',
    'data'=>'Aydos, 34896 Pendik/İstanbul',

]);
SiteSettings::create([

    'name' =>'phone',
    'data'=>'0532 532 00 00',

]);
SiteSettings::create([

    'name' =>'email',
    'data'=>'test@test.com',

]);

SiteSettings::create([

    'name' =>'harita',
    'data'=>'null',

]);


    }
}
