<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Wisata;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class WisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $code = ['321215100', '320937200', '320631200'];
        $faker = Factory::create('id_ID');
        for($i = 1; $i < 50; $i++) {
            $codeDesa = $code[array_rand($code)] . rand(1,8);
            $lastWisataId = Wisata::where('code_desa', $codeDesa)->orderBy('id', 'DESC')->first()->wisata_id ?? 0;
            $name = $faker->name;
            Wisata::create([
                'wisata_id' => $lastWisataId + 1,
                'code_desa' => $codeDesa,
                'name' => $faker->name,
                'slug' => Str::slug($name),
                'location' => $faker->name,
                'meta_description' => $faker->sentence,
                'meta_keyword' => $faker->name,
                'longtitude' => '-6.6897378',
                'latitude' => '108.4127686',
                'price' => rand(10000, 50000),
                'description' => $faker->paragraph(),
            ]);
        }
    }
}
