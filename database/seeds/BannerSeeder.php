<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'model_type' => 'App\EModels\Product',
                'model_id' => 6,
            ],
            [
                'model_type' => 'App\EModels\Post',
                'model_id' => 1,
            ],
            ]);
    }
}
