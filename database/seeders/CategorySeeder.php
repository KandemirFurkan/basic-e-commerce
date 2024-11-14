<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{

    public function run(): void
    {

   $erkek=     Category::create([
            'name' => 'Erkek',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Erkek Giyim',
            'cat_ust' => null,
            'status' => '1'

        ]);


         Category::create([
            'name' => 'Erkek Kazak',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Erkek Kazak',
            'cat_ust' => $erkek->id,
            'status' => '1'

        ]);

        Category::create([
            'name' => 'Erkek Pantolon',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Erkek Pnatolonlar',
            'cat_ust' => $erkek->id,
            'status' => '1'

        ]);

        $kadin =      Category::create([
            'name' => 'Kadın',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Kadın Giyim',
            'cat_ust' => null,
            'status' => '1'

        ]);

        Category::create([
            'name' => 'Kadın Çanta',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Kadın Çantalar',
            'cat_ust' => $kadin->id,
            'status' => '1'

        ]);

        Category::create([
            'name' => 'Kadın Pantolon',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Kadın Pantolonlar',
            'cat_ust' => $kadin->id,
            'status' => '1'

        ]);

        $cocuk=       Category::create([
            'name' => 'Çocuk',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Çocuk Giyim',
            'cat_ust' => null,
            'status' => '1'

        ]);
 Category::create([
            'name' => 'Çocuk Oyuncak',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Çocuk Oyuncaklar',
            'cat_ust' => $cocuk->id,
            'status' => '1'

        ]);

        Category::create([
            'name' => 'Çocuk Pantolon',
            'thumbnail' => null,
            'image' => null,
            'content' => 'Çocuk Pantolonlar',
            'cat_ust' => $cocuk->id,
            'status' => '1'

        ]);

    }
}
