<?php

namespace Database\Seeders;

use App\Models\Key;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Key::create([
            'key' => '4eUUTcAPMbAlgsLSvRovpFBe4u7UAm8HNl69RJ8oiLNuGCRCiOg2DIJqEwMrn2NX'
        ]);
    }
}
