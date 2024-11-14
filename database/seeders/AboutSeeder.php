<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      About::create([
        'name' => 'BioShop Kimdir',
        'content' => 'Hakkımızda yazısı buraya gelecektir.',
        'text_1' => 'Ücretsiz Kargo',
        'text_1_icon' => 'icon-truck',
        'text_1_content' => 'Ürünlerimizi ücretsiz kargo ile gönderiyoruz.',
        'text_2' => 'GERI İADE',
        'text_2_icon' => 'icon-refresh2',
        'text_2_content' => 'Ürünlerimizi 14 gün içinde koşulsuz şartsız iade alıyoruz.',
        'text_3' => 'MÜŞTERI DESTEĞI',
        'text_3_icon' => 'icon-help',
        'text_3_content' => 'Müşteri temsilcilerimize 7/24 ulaşabilirsiniz.'


      ]);
    }
}
