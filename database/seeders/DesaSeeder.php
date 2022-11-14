<?php

namespace Database\Seeders;

use App\Models\Desa;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kecamatan Gempol Kabupaten Cirebon
        for($i = 1; $i <= 8; $i++) {
            Desa::create([
                'code' => '320937200' . $i,
                'district_code' => '320937',
                'city_code' => '3209',
                'url' => 'sipodes.com',
            ]);
        }

        // Kecamatan Sukaratu Kabupaten Tasikmalaya
        for($i = 1; $i <= 8; $i++) {
            Desa::create([
                'code' => '320631200' . $i,
                'district_code' => '320631',
                'city_code' => '3206',
                'url' => 'sipodes.com',
            ]);
        }

        // Kecamatan Indramayu Kabupaten Indramayu
        for($i = 1; $i <= 8; $i++) {
            Desa::create([
                'code' => '321215100' . $i,
                'district_code' => '321215',
                'city_code' => '3212',
                'url' => 'sipodes.com',
            ]);
        }
        Desa::create([
            'code' => '3212152009',
            'district_code' => '321215',
            'city_code' => '3212',
            'url' => 'sipodes.com',
        ]);

        for($i = 0; $i <= 7; $i++) {
            Desa::create([
                'code' => '321215201' . $i,
                'district_code' => '321215',
                'city_code' => '3212',
                'url' => 'sipodes.com',
            ]);
        }

        Desa::create([
            'code' => '3212152020',
            'district_code' => '321215',
            'city_code' => '3212',
            'url' => 'sipodes.com',
        ]);
    }
}
