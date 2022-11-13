<?php

namespace Database\Seeders;

use App\Models\Wisata;
use Faker\Factory;
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
            Wisata::create([
                'code_desa' => $code[array_rand($code)] . rand(1,8),
                'name' => $faker->name,
                'location' => $faker->name,
                'meta_description' => $faker->sentence,
                'meta_keyword' => $faker->name,
                'longtitude' => $faker->randomDigitNotNull(),
                'latitude' => $faker->randomDigitNotNull(),
                'price' => rand(10000, 50000),
                'description' => $faker->paragraph(),
            ]);
        }
    }
}
