<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
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
            $lastWisataId = Umkm::where('code_desa', $codeDesa)->orderBy('id', 'DESC')->first()->umkm_id ?? 0;
            $name = $faker->name;
            Umkm::create([
                'umkm_id' => $lastWisataId + 1,
                'code_desa' => $codeDesa,
                'name' => $faker->name,
                'location' => $faker->name,
                'contact' => $faker->name,
                'type_umkm' => $faker->name,
                'meta_description' => $faker->sentence,
                'meta_keyword' => $faker->name,
                'description' => $faker->paragraph(),
            ]);
        }
    }
}
